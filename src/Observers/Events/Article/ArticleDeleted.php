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


use Illuminate\Database\Eloquent\Collection;

class ArticleDeleted {

    public $articles = [];

    public function __construct(Collection $articles)
    {
        $this->articles = $articles;
    }

}