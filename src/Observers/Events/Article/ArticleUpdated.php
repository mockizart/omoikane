<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 16:38
 */

namespace Omoikane\Observers\Events\Article;


use Omoikane\Models\Article;

class ArticleUpdated {

    public $article;

    public $categories;

    public $tags;

    public function __construct(Article $article, Array $categories, array $tags)
    {
        $this->article = $article;
        $this->categories = $categories;
        $this->tags = $tags;
    }

}