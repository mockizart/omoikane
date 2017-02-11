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

use Omoikane\Observers\Events\Article\ArticleCreated;
use Omoikane\Services\Article\Contracts\ArticleTagCrud;

class CreateArticleTag {

    protected $articleTagCrud;

    public function __construct(ArticleTagCrud $articleTagCrud)
    {
        $this->articleTagCrud = $articleTagCrud;
    }

    public function handle(ArticleCreated $articleCreated)
    {
        $this->articleTagCrud->create($articleCreated->article->id, $articleCreated->tags);
    }

}