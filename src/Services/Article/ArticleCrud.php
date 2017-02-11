<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 6:38
 */

namespace Omoikane\Services\Article;

use Omoikane\Models\Article;
use Omoikane\Observers\Events\Article\ArticleCreated;
use Omoikane\Observers\Events\Article\ArticleDeleted;
use Omoikane\Observers\Events\Article\ArticleUpdated;
use Omoikane\Repositories\Contracts\ArticleRepository;
use Omoikane\Services\Article\Contracts\ArticleCategoryCrud;
use Omoikane\Services\Article\Contracts\ArticleCrud as ArticleCrudContract;
use Auth;

class ArticleCrud implements ArticleCrudContract{

    protected $articleRepository;

    protected $articleCategoryCrud;

    public function __construct(ArticleRepository $articleRepository, ArticleCategoryCrud $articleCategoryCrud)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCategoryCrud = $articleCategoryCrud;
    }

    public function create($title, $slug, $keyword, $body, $description, Array $categories, Array $tags)
    {
        $save = $this->articleRepository->create(
            Auth::id(),
            $title,
            (empty($slug)) ? $title : $slug,
            $keyword,
            $body,
            $description
        );

        if ($save) {
            event(new ArticleCreated($save, $categories, $tags));
            return $save;
        }

        return false;
    }

    public function update($articleId, $title, $slug, $keyword, $body, $description, Array $categories = [], Array $tags)
    {
        $updated = $this->articleRepository->update(
            $articleId,
            null,
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        if ($updated) {
            event(new ArticleUpdated($updated, $categories, $tags));
            return $updated;
        }

        return false;
    }

    public function delete(Array $id)
    {
        $deletedCategories = $this->articleRepository->delete($id);

        if ($deletedCategories) {
            event(new ArticleDeleted($deletedCategories));
            return $deletedCategories;
        }

        return false;
    }

}