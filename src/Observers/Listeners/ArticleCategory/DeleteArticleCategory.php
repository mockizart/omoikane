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

use Omoikane\Observers\Events\Article\ArticleDeleted;
use Omoikane\Services\Article\Contracts\ArticleCategoryCrud;

class DeleteArticleCategory {

    protected $articleCategoryCrud;

    public function __construct(ArticleCategoryCrud $articleCategoryCrud)
    {
        $this->articleCategoryCrud = $articleCategoryCrud;
    }

    public function handle(ArticleDeleted $articleDeleted)
    {
        if ($articleDeleted->articles) {

            foreach ($articleDeleted->articles as $dc) {
                $categories = (is_array($dc->category->toArray()))
                    ? array_column($dc->category->toArray(), 'category_id') : [];
                $this->articleCategoryCrud->delete($dc->id, $categories);
            }

        }
    }

}