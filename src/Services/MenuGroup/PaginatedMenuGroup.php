<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 17:56
 */

namespace Omoikane\Services\MenuGroup;

use Omoikane\Repositories\Contracts\MenuGroupRepository;
use Omoikane\Services\AbstractPaginatedPost;
use Omoikane\Services\MenuGroup\Contracts\PaginatedMenuGroup as PaginatedMenuGroupContract;

class PaginatedMenuGroup extends AbstractPaginatedPost implements PaginatedMenuGroupContract{

    protected $menuGroupRepository;

    public function __construct(MenuGroupRepository $menuGroupRepository)
    {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    public function paginatedData($limit = 20)
    {
        $path = $this->generatePaginatedPath();
        $data = $this->menuGroupRepository->paginateMenuGroup(
            $this->keyword, $path, $limit, $this->orderBy, $this->order
        );

        return $data;
    }
}