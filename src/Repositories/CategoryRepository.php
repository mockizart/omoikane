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

    public function getModel()
    {
        return $this->model;
    }

    public function autoComplete($keyword)
    {
        return $this->model->whereRaw('title like ?', ["%".$keyword."%"])->get();
    }

    public function findCategoryById($id)
    {
        return $this->model->find($id);
    }

    public function findCategoryBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    protected function findCategoriesById(Array $id)
    {
        $data = $this->model->whereIn('id', $id);

        return $data;
    }

    public function getCategories($parentId = 0)
    {
        $data = $this->model->where('parent_id', $parentId)->get();

        return $data;
    }

    public function create($userId, $parentId, $title, $slug, $keyword, $body, $description)
    {
        $this->model->user_id            = $userId;
        $this->model->parent_id          = $parentId;
        $this->model->title              = $title;
        $this->model->slug               = $slug;
        $this->model->meta_keyword       = $keyword;
        $this->model->body               = $body;
        $this->model->meta_description   = $description;
        $this->model->article_counter    = 0;

        $this->model->save();
    }

    public function update($categoryId, $parentId, $title, $slug, $keyword, $body, $description)
    {
        $category = $this->findCategoryById($categoryId);

        $category->parent_id          = (empty($parentId)) ? $category->parent_id : $parentId;
        $category->title              = (empty($title)) ? $category->title : $title;
        $category->slug               = (empty($slug)) ? $category->slug : $slug;
        $category->meta_keyword       = (empty($keyword)) ? $category->meta_keyword : $keyword;
        $category->body               = (empty($body)) ? $category->body : $body;
        $category->meta_description   = (empty($description)) ? $category->meta_description : $description;

        $category->save();
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

}