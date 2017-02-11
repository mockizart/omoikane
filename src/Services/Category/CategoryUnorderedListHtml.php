<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 15:35
 */

namespace Omoikane\Services\Category;


use Illuminate\Support\Facades\View;
use RecursiveIteratorIterator;
use Traversable;
use Omoikane\Services\Category\Contracts\CategoryUnorderedListHtml as Contract;

class CategoryUnorderedListHtml extends RecursiveIteratorIterator implements Contract  {

    // stores the previous depth
    private $_depth = 0;

    // stores the current iteration's depth
    private $_curDepth = 0;

    protected $availableOptions = ['checkbox', 'delete', 'edit'];

    protected $checkedCategories = [];

    public function __construct(Traversable $iterator, $mode = RecursiveIteratorIterator::SELF_FIRST, $flags = 0)
    {
        parent::__construct($iterator, $mode, $flags);
    }

    protected function view($category)
    {
        $data = [
            'category' => $category,
            'options'  => $this->availableOptions,
            'selected' => $this->checkedCategories
        ];

        return View::make('omoikane::partial.category-tree', $data)->render();
    }

    public function setAvailableOptions($options)
    {
        $this->availableOptions = $options;
    }

    public function setCheckedCategory(Array $id)
    {
        $this->checkedCategories = $id;
    }

    public function current()
    {
        // the return output string
        $output = '';

        // set the current depth
        $this->_curDepth = $this->getDepth();

        // store the difference in depths
        $diff = abs($this->_curDepth - $this->_depth);

        // close previous nested levels
        if ($this->_curDepth < $this->_depth) {
            $output .= str_repeat('</ul></li>', $diff);
        }
        
        $category = parent::current();

        // check if we have the last nav item
        if ($this->valid()) {
            $output .= '<li> '. $this->view($category) . ' ' . $category->title;
        } else {
            $output .= '<li class="last">' . $category->title;
        }

        // either add a subnav or close the list item
        if ($this->hasChildren()) {
            $output .= '<ul>';
        } else {
            $output .= '</li>';
        }

        // cache the depth
        $this->_depth = $this->_curDepth;

        // return the output ( we could've also overridden current())
        return $output;
    }

}