<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:55
 */

namespace Omoikane\Repositories\Contracts;


interface ArticleRepository {

    /**
     * Save an article
     *
     * @param $userId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function addArticle($userId, $title, $slug, $keyword, $body, $description);

    /**
     * Update an article
     *
     * @param $pageId
     * @param $userId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function updateArticle($pageId, $userId, $title, $slug, $keyword, $body, $description);

    /**
     * Delete an or more articles
     *
     * @param array $id
     * @return mixed
     */
    public function deleteArticle(Array $id);

    /**
     * Find one article by article ID.
     *
     * @param $id
     * @return mixed
     */
    public function findArticleById($id);

    /**
     * Return paginated article records.
     *
     * @param $keyword
     * @param $path
     * @param $limit
     * @param $orderBy
     * @param $order
     * @return mixed
     */
    public function paginateArticle($keyword, $path, $limit, $orderBy, $order);

    /**
     * Find article title like
     *
     * @param $keyword
     * @return mixed
     */
    public function findArticleTitleLike($keyword);

}