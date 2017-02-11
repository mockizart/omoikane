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

use Omoikane\Observers\Events\Article\ArticleDeleted;
use Omoikane\Services\Article\Contracts\ArticleTagCrud;

class DeleteArticleTag {

    protected $articleTagCrud;

    public function __construct(ArticleTagCrud $articleTagCrud)
    {
        $this->articleTagCrud = $articleTagCrud;
    }

    public function handle(ArticleDeleted $articleDeleted)
    {
        if ($articleDeleted->articles) {

            foreach ($articleDeleted->articles as $dc) {
                $tags = (is_array($dc->tag->toArray()))
                    ? array_column($dc->tag->toArray(), 'tag_id') : [];
                $this->articleTagCrud->delete($dc->id, $tags);
            }

        }
    }

}