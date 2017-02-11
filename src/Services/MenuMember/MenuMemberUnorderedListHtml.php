<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 15:35
 */

namespace Omoikane\Services\MenuMember;

use Illuminate\Support\Facades\View;
use RecursiveIteratorIterator;
use Traversable;
use Omoikane\Services\MenuMember\Contracts\MenuMemberUnorderedListHtml as Contract;

class MenuMemberUnorderedListHtml extends RecursiveIteratorIterator implements Contract  {

    // stores the previous depth
    private $_depth = 0;

    // stores the current iteration's depth
    private $_curDepth = 0;

    protected $availableOptions = ['checkbox', 'delete', 'edit'];

    protected $checkedMenuMembers = [];

    public function __construct(Traversable $iterator, $mode = RecursiveIteratorIterator::SELF_FIRST, $flags = 0)
    {
        parent::__construct($iterator, $mode, $flags);
    }

    protected function view($menuMember)
    {
        $data = [
            'menuMember' => $menuMember,
            'options'  => $this->availableOptions,
            'selected' => $this->checkedMenuMembers
        ];

        return View::make('omoikane::partial.menu-member-tree', $data)->render();
    }

    public function setAvailableOptions($options)
    {
        $this->availableOptions = $options;
    }

    public function setCheckedMenuMember(Array $id)
    {
        $this->checkedMenuMembers = $id;
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
        
        $menuMember = parent::current();

        // check if we have the last nav item
        if ($this->valid()) {

            $output .= '<li  class="the-members" id="'.$menuMember->id.'" data-array-key="'.$menuMember->dataArrayKey.'"> '.
                $this->view($menuMember);

            $output .= '<span data-id="menu-members' . $menuMember->dataArrayKey .'">' .
                $menuMember->name . ' - '. $menuMember->target . '</span>';

            $output .= '<input type="hidden" name="menu-members'.$menuMember->dataArrayKey.'[title]" '.
                'value="'.$menuMember->name.'" />';

            $output .= '<input type="hidden" name="menu-members'.$menuMember->dataArrayKey.'[target]" '.
                'value="'.$menuMember->target.'" />';

            $output .= '<input type="hidden" name="menu-members'.$menuMember->dataArrayKey.'[type]" '.
                'value="'.$menuMember->type.'" />';

        } else {

            $output .= '<li class="last">' . $menuMember->name;

        }

        // either add a subnav or close the list item
        if ($this->hasChildren()) {
            $output .= '<ul>';
        } else {
            $output .= '<ul></ul></li>';
        }

        // cache the depth
        $this->_depth = $this->_curDepth;

        // return the output ( we could've also overridden current())
        return $output;
    }

}