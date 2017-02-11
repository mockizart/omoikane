<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 6:49
 */

namespace Omoikane\Services\Article;

use Omoikane\Models\Article;
use Omoikane\Repositories\Contracts\ArticleTagRepository;
use Omoikane\Repositories\Contracts\TagRepository;
use Omoikane\Services\Article\Contracts\ArticleTagCrud as ArticleTagCrudContract;

class ArticleTagCrud implements ArticleTagCrudContract {

    protected $articleTag;

    protected $tagRepository;

    public function __construct(
        ArticleTagRepository $articleTagRepository,
        TagRepository $tagRepository
    )
    {
        $this->articleTag = $articleTagRepository;
        $this->tagRepository = $tagRepository;
    }

    public function create($articleId, Array $tagId)
    {
        $this->articleTag->save($articleId, $tagId);

        // update article_counter +1 in tag table
        $this->tagRepository->articleCounter($tagId, true);
    }

    public function delete($articleId, Array $tagId)
    {
        $this->articleTag->delete($articleId, $tagId);

        // update article_counter -1 in tag table
        $this->tagRepository->articleCounter($tagId, false);
    }

    public function update(Article $article, Array $tags)
    {
        $oldTags = array_column($article->tag->toArray(), 'tag_id');
        $newTags = $tags;

        $tagToRemove = array_diff($oldTags, $newTags);
        $tagToInsert = array_diff($newTags, $oldTags);

        $this->delete($article->id, $tagToRemove);
        $this->create($article->id, $tagToInsert);
    }

}