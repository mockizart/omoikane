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

final class PageRepository extends BasePostRepository implements PageRepositoryContract{

    protected $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function findPageById($id)
    {
        return $this->findById($id);
    }

    public function findPageByIdWithRelations($id, array $with)
    {
        return $this->findByIdWithRelations($id, $with);
    }

    public function findPageBySlug($slug)
    {
        return $this->findPostBySlug($slug);
    }

    public function findPublishedPages()
    {
        return $this->model->where('publish', true)->get();
    }

    public function addPage($userId, $status = 0, $title, $slug, $keyword = '', $body, $description = '')
    {
        $data = $this->getNewModel();
        
        $data->user_id            = $userId;
        $data->status             = $status;
        $data->title              = $title;
        $data->slug               = (empty($slug)) ? $title : $slug;
        $data->meta_keyword       = $keyword;
        $data->body               = $body;
        $data->meta_description   = $description;

        return ($data->save()) ? $data : false;
    }

    public function updatePage($pageId, $status = '', $title = '', $slug = '', $keyword = '', $body = '', $description = '')
    {
        $post = $this->findPageById($pageId);

        $post->status             = ($status==null) ? $post->status : $status;
        $post->title              = (empty($title)) ? $post->title : $title;
        $post->slug               = (empty($slug)) ? $post->slug : $slug;
        $post->meta_keyword       = (empty($keyword)) ? $post->meta_keyword : $keyword;
        $post->body               = (empty($body)) ? $post->body : $body;
        $post->meta_description   = (empty($description)) ? $post->meta_description : $description;

        return ($post->save()) ? $post : false;
    }

    public function deletePage(array $id)
    {
        return $this->delete($id);
    }

    public function paginatePage($keyword, $path, $limit, $orderBy, $order)
    {
        return $this->pagination($keyword, $path,  $limit, $orderBy, $order);
    }

    public function findPageTitleLike($keyword)
    {
        return parent::findPostTitleLike($keyword);
    }
}