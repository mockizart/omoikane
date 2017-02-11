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

use Omoikane\Models\ArticleCategory;
use Omoikane\Repositories\Contracts\ArticleCategoryRepository as ArticleCategoryRepositoryContract;

class ArticleCategoryRepository implements ArticleCategoryRepositoryContract{

    protected $articleCategory;

    public function __construct(ArticleCategory $articleCategory)
    {
        $this->articleCategory = $articleCategory;
    }

    public function getModel()
    {
        return $this->articleCategory;
    }

    public function save($articleId, Array $categoryId)
    {
        $data = [];

        foreach ($categoryId as $c) {
            $data[] = [
                'article_id' => $articleId,
                'category_id' => $c
            ];
        }

        $this->articleCategory->insert($data);
    }

    public function delete($articleId, array $categoryId)
    {
        $data = $this->articleCategory->whereIn('category_id', $categoryId)->where('article_id', $articleId);

        $data->delete();
    }

}