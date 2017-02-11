<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 05/02/17
 * Time: 10:07
 */

namespace Omoikane\Observers\Listeners\ArticleCategory;

use Omoikane\Observers\Events\Article\ArticleCreated;
use Omoikane\Services\Article\Contracts\ArticleCategoryCrud;

class CreateArticleCategory {

    protected $articleCategoryCrud;

    public function __construct(ArticleCategoryCrud $articleCategoryCrud)
    {
        $this->articleCategoryCrud = $articleCategoryCrud;
    }

    public function handle(ArticleCreated $articleCreated)
    {
        $this->articleCategoryCrud->create($articleCreated->article->id, $articleCreated->categories);
    }

}