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

use Omoikane\Models\Page;
use Omoikane\Repositories\Contracts\PageRepository as PageRepositoryContract;

class PageRepository extends BasePostRepository implements PageRepositoryContract{

    protected $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function autoComplete($keyword)
    {
        return $this->model->whereRaw('title like ?', ["%".$keyword."%"])->get();
    }


    public function findPageById($id)
    {
        return $this->findPostById($id);
    }

    public function findPageBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($userId, $status = 0, $title, $slug, $keyword = '', $body, $description = '')
    {
        $this->model->user_id            = $userId;
        $this->model->status             = $status;
        $this->model->title              = $title;
        $this->model->slug               = (empty($slug)) ? $title : $slug;
        $this->model->meta_keyword       = $keyword;
        $this->model->body               = $body;
        $this->model->meta_description   = $description;

        return ($this->model->save()) ? $this->model : false;
    }

    public function update($pageId, $status = '', $title = '', $slug = '', $keyword = '', $body = '', $description = '')
    {
        $post = $this->findPostById($pageId);

        $post->status              = ($status==null) ? $post->status : $status;
        $post->title              = (empty($title)) ? $post->title : $title;
        $post->slug               = (empty($slug)) ? $post->slug : $slug;
        $post->meta_keyword       = (empty($keyword)) ? $post->meta_keyword : $keyword;
        $post->body               = (empty($body)) ? $post->body : $body;
        $post->meta_description   = (empty($description)) ? $post->meta_description : $description;

        return ($post->save()) ? $post : false;
    }

}