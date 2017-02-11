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


interface ArticleTagRepository {

    /**
     * Save article-tag relationship (dont use this method directly, should be done using ArticleTagCrud)
     *
     * @param $articleId
     * @param array $tagId
     * @return mixed
     */
    public function save($articleId, Array $tagId);

    /**
     * Remove article-tag relationship (don't use this method directly, please use ArticleTagCrud object)
     *
     * @param $articleId
     * @param array $tagId
     * @return mixed
     */
    public function delete($articleId, array $tagId);

}