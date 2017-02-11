<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:56
 */

namespace Omoikane\Repositories;

use Omoikane\Models\Tag;
use Omoikane\Repositories\Contracts\TagRepository as TagRepositoryContract;

class TagRepository extends BasePostRepository implements TagRepositoryContract{

    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function autoComplete($keyword)
    {
        return $this->model->whereRaw('title like ?', ["%".$keyword."%"])->get();
    }

    public function findTagById($id)
    {
        return $this->model->find($id);
    }

    public function findTagBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    protected function findTagsById(Array $id)
    {
        $data = $this->model->whereIn('id', $id);

        return $data;
    }

    public function create($userId, $title, $slug, $keyword = '', $body, $description = '')
    {
        $this->model->user_id            = $userId;
        $this->model->title              = $title;
        $this->model->slug               = (empty($slug)) ? $title : $slug;
        $this->model->meta_keyword       = $keyword;
        $this->model->body               = $body;
        $this->model->meta_description   = $description;

        return ($this->model->save()) ? $this->model : false;
    }

    public function update($tagId, $title = '', $slug = '', $keyword = '', $body = '', $description = '')
    {
        $post = $this->findPostById($tagId);

        $post->title              = (empty($title)) ? $post->title : $title;
        $post->slug               = (empty($slug)) ? $post->slug : $slug;
        $post->meta_keyword       = (empty($keyword)) ? $post->meta_keyword : $keyword;
        $post->body               = (empty($body)) ? $post->body : $body;
        $post->meta_description   = (empty($description)) ? $post->meta_description : $description;

        return ($post->save()) ? $post : false;
    }

    public function articleCounter(Array $id, $increase = true)
    {
        $category = $this->findTagsById($id);

        if ($increase) {
            $category->increment('article_counter');
        } else {
            $category->decrement('article_counter');
        }
    }

}