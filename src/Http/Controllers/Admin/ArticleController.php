<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:36
 */

namespace Omoikane\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omoikane\Repositories\Contracts\ArticleRepository;
use Auth;
use Omoikane\Services\Category\CategoryUnorderedListHtml;
use Omoikane\Services\Article\Contracts\ArticleCrud;
use Omoikane\Services\Category\Contracts\CategoryList;
use Omoikane\Services\Article\Contracts\PaginatedArticle;
use Omoikane\Validations\Contracts\ArticleValidation;

class ArticleController extends BaseAdminController{

    protected $articleRepository;

    protected $categoryList;

    protected $articleCrud;

    protected $paginatedArticle;

    protected $articleValidation;

    public function __construct(
        ArticleRepository $articleRepository,
        CategoryList $categoryList,
        ArticleCrud $articleCrud,
        PaginatedArticle $paginatedArticle,
        ArticleValidation $articleValidation
    )
    {
        parent::__construct();
        $this->articleCrud = $articleCrud;
        $this->articleRepository = $articleRepository;
        $this->categoryList = $categoryList;
        $this->paginatedArticle = $paginatedArticle;
        $this->articleValidation = $articleValidation;
    }

    protected function categoryRecursive($checked = [])
    {
        $categories = $this->categoryList;
        $categories->setParentId(0);
        $categories = new CategoryUnorderedListHtml(
            $categories
        );

        $categories->setView($this->pathView.'partial.category-tree');
        $categories->setAvailableOptions(['checkbox']);
        $categories->setCheckedCategory($checked);

        return $categories;
    }

    public function autoComplete(Request $request)
    {
        $keyword        = $request->input('keyword', '');
        $data           = $this->articleRepository->findArticleTitleLike($keyword);
        $return = response()->json($data);

        return $return;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $orderBy = $request->input('orderBy', 'created_at');
        $order = $request->input('order', 'desc');

        $data = $this->paginatedArticle->setKeyword($keyword)->setOrderBy($orderBy, $order)->paginatedData();

        $orderForLink = ($order=='desc') ? 'asc' : 'desc';

        $dataToView = [
            'articles' => $data,
            'orderLink' => $orderForLink
        ];

        return view($this->pathView.'article.index', $dataToView);
    }

    public function create()
    {
        $data = [
            'categories' => $this->categoryRecursive(),
        ];

        return view($this->pathView.'article.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->articleValidation->rules);

        $this->articleCrud->create(
            $request->input('title'),
            $request->input('slug'),
            $request->input('keyword'),
            $request->input('body'),
            $request->input('description'),
            $request->input('category', []),
            $request->input('tag', [])
        );

        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->articleRepository->findArticleById($id);

        if (!$data) {
            abort(404);
        }

        $checkedCategories = array_column($data->category->toArray(), 'category_id');
        $categories = $this->categoryRecursive($checkedCategories);

        $data = [
            'article' => $data,
            'categories' => $categories
        ];

        return view($this->pathView.'article.edit', $data);
    }

    public function update($id, Request $request)
    {
        $data = $this->articleRepository->findArticleById($id);

        if (!$data) {
            abort(404);
        }

        $this->validate($request, $this->articleValidation->rules);

        $this->articleCrud->update(
            $data->id,
            $request->input('title'),
            $request->input('slug'),
            $request->input('keyword'),
            $request->input('body'),
            $request->input('description'),
            $request->input('category', []),
            $request->input('tag', [])
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->articleCrud->delete([$id]);

        return redirect()->route('indexArticle');
    }

}