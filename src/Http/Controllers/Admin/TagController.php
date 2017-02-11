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
use Omoikane\Repositories\Contracts\TagRepository;
use Auth;
use Omoikane\Services\Tag\Contracts\PaginatedTag;
use Omoikane\Services\Tag\Contracts\TagCrud;
use Omoikane\Validations\Contracts\TagValidation;

class TagController extends Controller{

    protected $tagRepository;

    protected $tagCrud;

    protected $paginatedTag;

    protected $tagValidation;

    public function __construct(
        TagRepository $tagRepository,
        TagCrud $tagCrud,
        PaginatedTag $paginatedTag,
        TagValidation $tagValidation
    )
    {
        $this->tagRepository = $tagRepository;
        $this->tagCrud = $tagCrud;
        $this->paginatedTag = $paginatedTag;
        $this->tagValidation = $tagValidation;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $orderBy = $request->input('orderBy', 'created_at');
        $order = $request->input('order', 'desc');

        $data = $this->paginatedTag->setKeyword($keyword)->setOrderBy($orderBy, $order)->paginatedData();

        $orderForLink = ($order=='desc') ? 'asc' : 'desc';

        $dataToView = [
            'tags' => $data,
            'orderLink' => $orderForLink
        ];

        return view('omoikane::tag.index', $dataToView);
    }

    public function create()
    {
        return view('omoikane::tag.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->tagValidation->rules);

        $this->tagCrud->create(
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
        $data = $this->tagRepository->findTagById($id);

        if (!$data) {
            abort(404);
        }

        return view('omoikane::tag.edit', ['tag' => $data]);
    }

    public function update($id, Request $request)
    {
        $data = $this->tagRepository->findTagById($id);

        if (!$data) {
            abort(404);
        }

        $this->validate($request, $this->tagValidation->rules);

        $this->tagCrud->update(
            $data->id,
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
        $this->tagCrud->delete([$id]);

        return redirect()->route('indexTag');
    }


    public function autoComplete(Request $request)
    {
        $keyword        = $request->input('keyword', '');
        $data           = $this->tagRepository->autoComplete($keyword);
        $return = response()->json($data);

        return $return;
    }
}