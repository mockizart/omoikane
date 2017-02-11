<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 05/02/17
 * Time: 10:07
 */

namespace Omoikane\Observers\Listeners\ArticleTag;

use Omoikane\Observers\Events\Article\ArticleUpdated;
use Omoikane\Services\Article\Contracts\ArticleTagCrud;

class UpdateArticleTag {

    protected $articleTagCrud;

    public function __construct(ArticleTagCrud $articleTagCrud)
    {
        $this->articleTagCrud = $articleTagCrud;
    }

    public function handle(ArticleUpdated $articleUpdated)
    {
        $this->articleTagCrud->update($articleUpdated->article, $articleUpdated->tags);
    }

}