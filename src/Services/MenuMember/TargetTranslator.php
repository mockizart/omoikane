<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 13/02/17
 * Time: 4:15
 */

namespace Omoikane\Services\MenuMember;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Routing\Route;
use Omoikane\Repositories\Contracts\ArticleRepository;
use Omoikane\Repositories\Contracts\CategoryRepository;
use Omoikane\Repositories\Contracts\PageRepository;
use Omoikane\Repositories\Contracts\TagRepository;
use Omoikane\Services\MenuMember\Contracts\TargetTranslator as Contract;

class TargetTranslator implements Contract{

    protected $articleRepository;

    protected $urlGenerator;

    protected $pageRepository;

    protected $categoryRepository;

    protected $tagRepository;

    public function __construct(
        UrlGenerator $urlGenerator,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        PageRepository $pageRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->urlGenerator = $urlGenerator;
        $this->pageRepository = $pageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function article($articleId)
    {
        $data = $this->articleRepository->findArticleById($articleId);

        if ($data) {
            return $data->slug;
        }

        return 'slug not found';
    }

    public function page($pageId)
    {
        $data = $this->pageRepository->findPageById($pageId);

        if ($data) {
            return $data->slug;
        }

        return 'slug not found';
    }

    public function category($categoryId)
    {
        $data = $this->categoryRepository->findCategoryById($categoryId);

        if ($data) {
            return $data->slug;
        }

        return 'slug not found';
    }

    public function tag($tagId)
    {
        $data = $this->tagRepository->findTagById($tagId);

        if ($data) {
            return $data->slug;
        }

        return 'slug not found';
    }

    public function route($name)
    {
        return route($name);
    }

    public function translate($target)
    {
        $re = '/(?P<name>[a-zA-Z]+)\(((?P<id>[0-9])|(?P<value>[a-zA-Z]+)+)/';

        preg_match($re, $target, $matches);

        if (isset($matches['name']) && (isset($matches['id']) || isset($matches['value']))) {
            switch ($matches[1]) {
                case 'route':
                    return $this->route($matches['value']);
                break;
                case 'article':
                    return $this->urlGenerator->to($this->article($matches['id']));
                break;
                case 'page':
                    return $this->urlGenerator->to($this->page($matches['id']));
                break;
                case 'category':
                    return $this->urlGenerator->to($this->category($matches['id']));
                break;
                case 'tag':
                    return $this->urlGenerator->to($this->tag($matches['id']));
                break;
            }
        }

        return $target;
    }

}