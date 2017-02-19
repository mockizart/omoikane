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
use Omoikane\Repositories\CategoryRepository;
use Omoikane\Repositories\Contracts\ArticleRepository;

class CategoryController extends Controller{

    protected $categoryRepository;

    protected $articleRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $dataToView = [];

        return view('omoikane::category.frontend.index', $dataToView);
    }

    public function view($slug)
    {
        $category = $this->categoryRepository->findCategoryBySlug($slug);

        if (!$category) {
            abort(404);
        }

        $dataToView = [
            'category' => $category,
            'articles' => $this->articleRepository->findArticlesByCategoryModel($category, 10)
        ];

        return view('omoikane::category.frontend.view', $dataToView);
    }

    public function sitemap()
    {
        $categories = $this->categoryRepository->pagination('', '', 100, 'id', 'desc');

        $dataToView = [
            'routeName' => 'frontendViewCategory',
            'posts' => $categories
        ];

        $view = view('omoikane::partial.post-sitemap', $dataToView);

        return response($view, 200)->header('Content-Type', 'text/xml');

    }

}