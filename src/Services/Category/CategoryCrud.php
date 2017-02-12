<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 20:30
 */

namespace Omoikane\Services\Category;

use Omoikane\Models\Category;
use Omoikane\Repositories\Contracts\CategoryRepository;
use Omoikane\Services\Category\Contracts\CategoryCrud as CategoryCrudContract;
use Auth;

class CategoryCrud implements CategoryCrudContract {

    protected $categoryRepository;

    protected $categoryList;

    public function __construct(CategoryRepository $categoryRepository, CategoryList $categoryList)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryList = $categoryList;
    }

    public function create($parentId, $title, $slug, $keyword, $body, $description)
    {
        $save = $this->categoryRepository->addCategory(
            Auth::id(),
            $parentId,
            $title,
            (empty($slug)) ? $title : $slug,
            $keyword,
            $body,
            $description
        );

        return $save;
    }

    public function update($categoryId, $parentId, $title, $slug, $keyword, $body, $description)
    {
        $updated = $this->categoryRepository->updateCategory(
            $categoryId,
            $parentId,
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        return $updated;
    }

    public function delete($id)
    {
        $data = $this->categoryRepository->findCategoryById($id);
        $idToRemove = [];

        if ($data) {
            $categories = $this->categoryList;
            $categories->setParentId($data->id);
            $descendants = new \RecursiveIteratorIterator($categories, \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($descendants as $v)
            {
                $idToRemove[] = $v->id;
            }
        }

        $idToRemove = array_merge($idToRemove, [$data->id]);

        $this->categoryRepository->deleteCategory($idToRemove);
    }

}