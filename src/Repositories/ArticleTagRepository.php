<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:56
 */

namespace Omoikane\Repositories;

use Omoikane\Models\ArticleTag;
use Omoikane\Repositories\Contracts\ArticleTagRepository as ArticleTagRepositoryContract;

class ArticleTagRepository implements ArticleTagRepositoryContract{

    protected $articleTag;

    public function __construct(ArticleTag $articleTag)
    {
        $this->articleTag = $articleTag;
    }

    public function getModel()
    {
        return $this->articleTag;
    }

    public function save($articleId, Array $tagId)
    {
        $data = [];

        foreach ($tagId as $c) {
            $data[] = [
                'article_id' => $articleId,
                'tag_id' => $c
            ];
        }

        $this->articleTag->insert($data);
    }

    public function delete($articleId, array $tagId)
    {
        $data = $this->articleTag->whereIn('tag_id', $tagId)->where('article_id', $articleId);

        $data->delete();
    }

}