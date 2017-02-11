<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 9:10
 */

namespace Omoikane\Services\Category;


use Omoikane\Repositories\Contracts\CategoryRepository;
use Omoikane\Services\Category\Contracts\CategoryList as CategoryListContract;

class CategoryList implements \RecursiveIterator, CategoryListContract {

    protected $categoryRepository;

    protected $categories;

    protected $counter = 0;

    protected $parentId;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function setParentId($id)
    {
        $this->parentId = $id;
    }

    public function getCategories($parentId = 0)
    {
        $this->categories = $this->categoryRepository->getCategories($parentId);
    }

    public function hasChildren()
    {
       return $this->categoryRepository->getCategories($this->current()->id)->count();
    }

    public function getChildren()
    {
        $children = new CategoryList($this->categoryRepository);
        $children->setParentId($this->current()->id);

        return $children;
    }

    public function current()
    {
        return $this->categories[$this->counter];
    }

    public function key ()
    {
        return $this->counter;
    }
    public function next ()
    {
        return $this->counter++;
    }

    public function rewind ()
    {
        $this->getCategories($this->parentId);

        return $this->counter = 0;
    }
    public function valid ()
    {
        return $this->counter < count($this->categories);
    }

}