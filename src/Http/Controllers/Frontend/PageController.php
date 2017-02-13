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
use Omoikane\Repositories\PageRepository;

class PageController extends Controller{

    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index($slug)
    {
        $page = $this->pageRepository->findPageBySlug($slug);

        if (!$page) {
            abort(404);
        }

        $dataToView = [
            'page' => $page,
        ];

        return view('omoikane::page.frontend.index', $dataToView);
    }

}