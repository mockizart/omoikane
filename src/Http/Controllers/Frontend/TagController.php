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
use Omoikane\Repositories\TagRepository;

class TagController extends Controller{

    protected $tagRepository;

    protected $articleRepository;

    public function __construct(
        TagRepository $tagRepository,
        ArticleRepository $articleRepository
    )
    {
        $this->tagRepository = $tagRepository;
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $dataToView = [
            'mostViewed' => $this->tagRepository->getMostViewedTags(),
        ];

        return view('omoikane::tag.frontend.index', $dataToView);
    }

    public function view($slug)
    {
        $tag = $this->tagRepository->findTagBySlug($slug);

        if (!$tag) {
            abort(404);
        }

        $dataToView = [
            'tag' => $tag,
            'articles' => $this->articleRepository->findArticlesByTagModel($tag, 10)
        ];

        return view('omoikane::tag.frontend.view', $dataToView);
    }


    public function sitemap()
    {
        $tags = $this->tagRepository->pagination('', '', 100, 'id', 'desc');

        $dataToView = [
            'routeName' => 'frontendViewTag',
            'posts' => $tags
        ];

        $view = view('omoikane::partial.post-sitemap', $dataToView);

        return response($view, 200)->header('Content-Type', 'text/xml');

    }

}