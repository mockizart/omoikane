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

use Omoikane\Models\Article;
use Omoikane\Repositories\Contracts\ArticleRepository as ArticleRepositoryContract;

class ArticleRepository extends BasePostRepository implements ArticleRepositoryContract{

    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function findArticleById($id)
    {
        return $this->model->find($id);
    }

    public function autoComplete($keyword)
    {
        return $this->model->whereRaw('title like ?', ["%".$keyword."%"])->get();
    }

    public function create($userId, $title, $slug, $keyword, $body, $description)
    {
        $this->model->user_id            = $userId;
        $this->model->title              = $title;
        $this->model->slug               = $slug;
        $this->model->meta_keyword       = $keyword;
        $this->model->body               = $body;
        $this->model->meta_description   = $description;

        return ($this->model->save()) ? $this->model : false;
    }

    public function update($postId, $userId, $title, $slug, $keyword, $body, $description)
    {
        $post = $this->findPostById($postId);

        $post->title = (empty($title)) ? $post->title : $title;
        $post->slug = (empty($slug)) ? $post->slug : $slug;
        $post->meta_keyword = (empty($keyword)) ? $post->meta_keyword : $keyword;
        $post->body = (empty($body)) ? $post->body : $body;
        $post->meta_description = (empty($description)) ? $post->meta_description : $description;

        return ($post->save()) ? $post : false;
    }

}