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

    public function findArticleBySlug($slug)
    {
        $data = $this->findPostBySlug($slug);

        return $data;
    }

    public function findArticlesByTagModel($tagModel, $limit)
    {
        if ($tagModel->article())
        {
            $data = $tagModel->article()->with(['user']);
            return $data->paginate($limit);
        }

        return false;
    }

    public function findArticlesByCategoryModel($categoryModel, $limit)
    {
        if ($categoryModel->article())
        {
            $data = $categoryModel->article()->with(['user']);
            return $data->paginate($limit);
        }

        return false;
    }

    public function addArticle($userId, $title, $slug, $keyword, $body, $description)
    {
        $data = $this->getNewModel();
        
        $data->user_id            = $userId;
        $data->title              = $title;
        $data->slug               = $slug;
        $data->meta_keyword       = $keyword;
        $data->body               = $body;
        $data->meta_description   = $description;

        return ($data->save()) ? $data : false;
    }

    public function updateArticle($postId, $userId, $title, $slug, $keyword, $body, $description)
    {
        $post = $this->findArticleById($postId);

        $post->title = (empty($title)) ? $post->title : $title;
        $post->slug = (empty($slug)) ? $post->slug : $slug;
        $post->meta_keyword = (empty($keyword)) ? $post->meta_keyword : $keyword;
        $post->body = (empty($body)) ? $post->body : $body;
        $post->meta_description = (empty($description)) ? $post->meta_description : $description;

        return ($post->save()) ? $post : false;
    }

    public function deleteArticle(Array $id)
    {
        return $this->delete($id);
    }

    public function paginateArticle($keyword, $path, $limit, $orderBy, $order)
    {
        return $this->pagination($keyword, $path,  $limit, $orderBy, $order);
    }

    public function findArticleTitleLike($keyword)
    {
        return parent::findPostTitleLike($keyword);
    }
}