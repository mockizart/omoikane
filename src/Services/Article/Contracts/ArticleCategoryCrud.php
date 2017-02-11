<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 6:48
 */

namespace Omoikane\Services\Article\Contracts;


use Omoikane\Models\Article;

interface ArticleCategoryCrud {

    /**
     * Insert article-category relationship and +1 article counter in table category
     *
     * @param $articleId
     * @param array $categoryId
     * @return mixed
     */
    public function create($articleId, Array $categoryId);

    /**
     * Remove article-category relationship and -1 article counter in table category.
     *
     * @param $articleId
     * @param array $categoryId
     * @return mixed
     */
    public function delete($articleId, Array $categoryId);

    /**
     * Find the different of old and new categories to insert or remove of an article.
     *
     * @param Article $article
     * @param array $categories
     * @return mixed
     */
    public function update(Article $article, Array $categories);

}