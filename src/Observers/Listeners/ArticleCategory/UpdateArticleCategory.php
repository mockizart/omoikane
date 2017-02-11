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

use Omoikane\Observers\Events\Article\ArticleUpdated;
use Omoikane\Services\Article\Contracts\ArticleCategoryCrud;

class UpdateArticleCategory {

    protected $articleCategoryCrud;

    public function __construct(ArticleCategoryCrud $articleCategoryCrud)
    {
        $this->articleCategoryCrud = $articleCategoryCrud;
    }

    public function handle(ArticleUpdated $articleUpdated)
    {
        $this->articleCategoryCrud->update($articleUpdated->article, $articleUpdated->categories);
    }

}