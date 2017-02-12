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

    public function findTagById($id)
    {
        return $this->findById($id);
    }

    public function findTagBySlug($slug)
    {
        return $this->findPostBySlug($slug);
    }

    public function findTagsById(Array $id, $getResult = false)
    {
        $data = $this->model->whereIn('id', $id);

        return (!$getResult) ? $data : $data->get();
    }

    public function addTag($userId, $title, $slug, $keyword = '', $body, $description = '')
    {
        $this->model->user_id            = $userId;
        $this->model->title              = $title;
        $this->model->slug               = (empty($slug)) ? $title : $slug;
        $this->model->meta_keyword       = $keyword;
        $this->model->body               = $body;
        $this->model->meta_description   = $description;

        return ($this->model->save()) ? $this->model : false;
    }

    public function updateTag($tagId, $title = '', $slug = '', $keyword = '', $body = '', $description = '')
    {
        $post = $this->findTagById($tagId);

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

    public function paginateTag($keyword, $path, $limit, $orderBy, $order)
    {
        return $this->pagination($keyword, $path,  $limit, $orderBy, $order);
    }

    public function deleteTag(array $id)
    {
        return $this->delete($id);
    }

    public function findTagTitleLike($keyword)
    {
        return parent::findPostTitleLike($keyword);
    }

}