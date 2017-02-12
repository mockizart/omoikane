<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 17:56
 */

namespace Omoikane\Services\Article;


use Omoikane\Repositories\Contracts\ArticleRepository;

use Omoikane\Services\AbstractPaginatedPost;
use Omoikane\Services\Article\Contracts\PaginatedArticle as PaginatedArticleContract;

class PaginatedArticle extends AbstractPaginatedPost implements PaginatedArticleContract{

    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function paginatedData($limit = 20)
    {
        $path = $this->generatePaginatedPath();
        $data = $this->articleRepository->paginateArticle($this->keyword, $path, $limit, $this->orderBy, $this->order);

        return $data;
    }

}