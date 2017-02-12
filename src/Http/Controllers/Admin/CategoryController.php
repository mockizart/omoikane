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
use Omoikane\Repositories\Contracts\CategoryRepository;
use Auth;
use Omoikane\Services\Category\CategoryUnorderedListHtml;
use Omoikane\Services\Category\Contracts\CategoryCrud;
use Omoikane\Services\Category\Contracts\CategoryList;
use Omoikane\Validations\Contracts\CategoryValidation;

class CategoryController extends Controller{

    protected $categoryRepository;

    protected $categoryList;

    protected $categoryCrud;

    protected $categoryValidation;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryList $categoryList,
        CategoryCrud $categoryCrud,
        CategoryValidation $categoryValidation
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryList = $categoryList;
        $this->categoryCrud = $categoryCrud;
        $this->categoryValidation = $categoryValidation;
    }

    public function index(Request $request)
    {
        $data['categories'] = $this->categoryRecursive();

        return view('omoikane::category.index', ['data' => $data]);
    }

    protected function categoryRecursive($checked = [])
    {
        $categories = $this->categoryList;
        $categories->setParentId(0);
        $categories = new CategoryUnorderedListHtml(
            $categories
        );

        $categories->setAvailableOptions(['delete', 'edit']);
        $categories->setCheckedCategory($checked);

        return $categories;
    }

    public function autoComplete(Request $request)
    {
        $keyword        = $request->input('keyword', '');
        $data           = $this->categoryRepository->findCategoryTitleLike($keyword);
        $return = response()->json($data);

        return $return;
    }

    public function create()
    {
        $categories = $this->categoryList;
        $categories->setParentId(0);

        $c = new \RecursiveIteratorIterator($categories, \RecursiveIteratorIterator::SELF_FIRST);

        return view('omoikane::category.create', ['categories' => $c]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->categoryValidation->rules);

        $this->categoryCrud->create(
            $request->input('parent_id', 0),
            $request->input('title'),
            $request->input('slug'),
            $request->input('keyword'),
            $request->input('body'),
            $request->input('description')
        );

        return redirect()->back();
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryList;
        $categories->setParentId(0);

        $c = new \RecursiveIteratorIterator($categories, \RecursiveIteratorIterator::SELF_FIRST);

        $data = [
            'category' => $category,
            'categories' => $c
        ];

        if (!$data['category']) {
            abort(404);
        }

        return view('omoikane::category.edit', $data);
    }

    public function update($id, Request $request)
    {
        $data = $this->categoryRepository->findCategoryById($id);

        if (!$data) {
            abort(404);
        }

        $this->validate($request, $this->categoryValidation->rules);

        $this->categoryCrud->update(
            $data->id,
            $request->input('parent_id', 0),
            $request->input('title'),
            $request->input('slug'),
            $request->input('keyword'),
            $request->input('body'),
            $request->input('description')
        );


        return redirect()->back();

    }

    public function destroy($id, Request $request)
    {
        $this->categoryCrud->delete($id);

        return redirect()->back();
    }

}