<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 8:07
 */

namespace Omoikane\Repositories;

use Omoikane\Models\Category;
use Omoikane\Repositories\Contracts\CategoryRepository as CategoryRepositoryContract;

class CategoryRepository extends BasePostRepository implements CategoryRepositoryContract {

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function findCategoryById($id)
    {
        return $this->findById($id);
    }

    public function findCategoryBySlug($slug)
    {
        return $this->findPostBySlug($slug);
    }

    protected function findCategoriesById(Array $id)
    {
        $data = $this->model->whereIn('id', $id);

        return $data;
    }

    public function getCategoriesByParentId($parentId = 0)
    {
        $data = $this->model->where('parent_id', $parentId)->get();

        return $data;
    }

    public function addCategory($userId, $parentId, $title, $slug, $keyword, $body, $description)
    {
        $data = $this->getNewModel();
        
        $data->user_id            = $userId;
        $data->parent_id          = $parentId;
        $data->title              = $title;
        $data->slug               = $slug;
        $data->meta_keyword       = $keyword;
        $data->body               = $body;
        $data->meta_description   = $description;
        $data->article_counter    = 0;

        return ($data->save()) ? $data : false;
    }

    public function updateCategory($categoryId, $parentId, $title, $slug, $keyword, $body, $description)
    {
        $category = $this->findCategoryById($categoryId);

        $category->parent_id          = (empty($parentId)) ? $category->parent_id : $parentId;
        $category->title              = (empty($title)) ? $category->title : $title;
        $category->slug               = (empty($slug)) ? $category->slug : $slug;
        $category->meta_keyword       = (empty($keyword)) ? $category->meta_keyword : $keyword;
        $category->body               = (empty($body)) ? $category->body : $body;
        $category->meta_description   = (empty($description)) ? $category->meta_description : $description;

        return ($category->save()) ? $category : false;
    }

    public function articleCounter(Array $id, $increase = true)
    {
        $category = $this->findCategoriesById($id);

        if ($increase) {
            $category->increment('article_counter');
        } else {
            $category->decrement('article_counter');
        }
    }

    public function deleteCategory(array $id)
    {
        return $this->delete($id);
    }

    public function findCategoryTitleLike($keyword)
    {
        return $this->findPostTitleLike($keyword);
    }

}