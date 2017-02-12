<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 17:56
 */

namespace Omoikane\Services\Page;

use Omoikane\Repositories\Contracts\PageRepository;
use Omoikane\Services\AbstractPaginatedPost;
use Omoikane\Services\Page\Contracts\PaginatedPage as PaginatedPageContract;

class PaginatedPage extends AbstractPaginatedPost implements PaginatedPageContract{

    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function paginatedData($limit = 20)
    {
        $path = $this->generatePaginatedPath();
        $data = $this->pageRepository->paginatePage($this->keyword, $path, $limit, $this->orderBy, $this->order);

        return $data;
    }

}