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
use Omoikane\Repositories\Contracts\PageRepository;
use Omoikane\Services\Page\Contracts\PageCrud;
use Omoikane\Services\Page\Contracts\PaginatedPage;
use Omoikane\Validations\Contracts\PageValidation;

class PageController extends Controller{

    protected $pageRepository;

    protected $paginatedPage;

    protected $pageCrud;

    protected $pageValidation;

    public function __construct(
        PageRepository $pageRepository,
        PaginatedPage $paginatedPage,
        PageCrud $pageCrud,
        PageValidation $pageValidation
    )
    {
        $this->pageRepository = $pageRepository;
        $this->paginatedPage = $paginatedPage;
        $this->pageCrud = $pageCrud;
        $this->pageValidation = $pageValidation;
    }

    public function autoComplete(Request $request)
    {
        $keyword        = $request->input('keyword', '');
        $data           = $this->pageRepository->findTitlePageLike($keyword);
        $return = response()->json($data);

        return $return;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $orderBy = $request->input('orderBy', 'created_at');
        $order = $request->input('order', 'desc');

        $data = $this->paginatedPage->setKeyword($keyword)->setOrderBy($orderBy, $order)->paginatedData();

        $orderForLink = ($order=='desc') ? 'asc' : 'desc';

        $dataToView = [
            'pages' => $data,
            'orderLink' => $orderForLink
        ];

        return view('omoikane::page.index', $dataToView);
    }

    public function create()
    {
        return view('omoikane::page.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->pageValidation->rules);

        $this->pageCrud->create(
            $request->input('status'),
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
        $dataToView = [
            'page' => $this->pageRepository->findPageById($id)
        ];

        if (!$dataToView['page']) {
            abort(404);
        }

        return view('omoikane::page.edit', $dataToView);
    }

    public function update($id, Request $request)
    {
        $data = $this->pageRepository->findPageById($id);

        if (!$data) {
            abort(404);
        }

        $this->validate($request, $this->pageValidation->rules);

        $this->pageCrud->update(
            $id,
            $request->input('status'),
            $request->input('title'),
            $request->input('slug'),
            $request->input('keyword'),
            $request->input('body'),
            $request->input('description')
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->pageCrud->delete([$id]);

        return redirect()->route('indexPage');
    }

}