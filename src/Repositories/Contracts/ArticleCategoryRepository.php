<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 02/02/17
 * Time: 13:27
 */

namespace Omoikane\Repositories\Contracts;


interface ArticleCategoryRepository {

    /**
     * Save article-category relationship (dont use this method directly, should be done using ArticleCategoryCrud)
     *
     * @param $articleId
     * @param array $categoryId
     * @return mixed
     */
    public function save($articleId, Array $categoryId);

    /**
     * Remove article-category relationship (don't use this method directly, please use ArticleCategoryCrud object)
     *
     * @param $articleId
     * @param array $categoryId
     * @return mixed
     */
    public function delete($articleId, array $categoryId);

}