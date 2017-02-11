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

interface ArticleTagCrud {

    /**
     * Insert article-tag relationship and +1 article counter in table tag
     *
     * @param $articleId
     * @param array $tagId
     * @return mixed
     */
    public function create($articleId, Array $tagId);

    /**
     * Remove article-tag relationship and -1 article counter in table tag.
     *
     * @param $articleId
     * @param array $tagId
     * @return mixed
     */
    public function delete($articleId, Array $tagId);

    /**
     * Find the different of old and new tags to insert or remove of an article.
     *
     * @param Article $article
     * @param array $tags
     * @return mixed
     */
    public function update(Article $article, Array $tags);


}