<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 6:39
 */

namespace Omoikane\Services\Article\Contracts;


interface ArticleCrud {

    /**
     * Create an article and trigger ArticleCreated event.
     *
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @param array $categories
     * @param array $tags
     * @return mixed
     */
    public function create($title, $slug, $keyword, $body, $description, Array $categories, Array $tags);

    /**
     * Update an article and trigger ArticleUpdated event.
     *
     * @param $articleId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @param array $categories
     * @param array $tags
     * @return mixed
     */
    public function update($articleId, $title, $slug, $keyword, $body, $description, Array $categories = [], Array $tags);

    /**
     * remove an article
     *
     * @param $id
     * @return mixed
     */
    public function delete(Array $id);

}