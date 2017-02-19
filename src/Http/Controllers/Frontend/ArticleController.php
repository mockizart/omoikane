<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 13/02/17
 * Time: 12:57
 */

namespace Omoikane\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Omoikane\Repositories\Contracts\ArticleRepository;

class ArticleController extends Controller{

    protected $articleRepository;

    protected $topArticles;

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function view($slug)
    {
        $article = $this->articleRepository->findArticleBySlug($slug);

        if (!$article) {
            abort(404);
        }

        $dataToView = [
            'article' => $article
        ];

        return view('omoikane::article.frontend.view', $dataToView);
    }


    public function sitemap()
    {
        $articles = $this->articleRepository->pagination('', '', 100, 'id', 'desc');

        $dataToView = [
            'routeName' => 'frontendViewArticle',
            'posts' => $articles
        ];

        $view = view('omoikane::partial.post-sitemap', $dataToView);

        return response($view, 200)->header('Content-Type', 'text/xml');

    }

}