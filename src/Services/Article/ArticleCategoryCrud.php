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
use Omoikane\Repositories\Contracts\ArticleCategoryRepository;
use Omoikane\Repositories\Contracts\CategoryRepository;
use Omoikane\Services\Article\Contracts\ArticleCategoryCrud as ArticleCategoryCrudContract;

class ArticleCategoryCrud implements ArticleCategoryCrudContract {

    protected $articleCategory;

    protected $categoryRepository;

    public function __construct(
        ArticleCategoryRepository $articleCategoryRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->articleCategory = $articleCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function create($articleId, Array $categoryId)
    {
        $this->articleCategory->save($articleId, $categoryId);

        // update article_counter +1 in category table
        $this->categoryRepository->articleCounter($categoryId, true);
    }

    public function delete($articleId, Array $categoryId)
    {
        $this->articleCategory->delete($articleId, $categoryId);

        // update article_counter -1 in category table
        $this->categoryRepository->articleCounter($categoryId, false);
    }

    public function update(Article $article, Array $categories)
    {
        $oldCategories = array_column($article->category->toArray(), 'category_id');
        $newCategories = $categories;

        $categoryToRemove = array_diff($oldCategories, $newCategories);
        $categoryToInsert = array_diff($newCategories, $oldCategories);

        $this->delete($article->id, $categoryToRemove);
        $this->create($article->id, $categoryToInsert);
    }

}