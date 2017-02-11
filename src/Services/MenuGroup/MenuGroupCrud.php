<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 07/02/17
 * Time: 12:08
 */

namespace Omoikane\Services\MenuGroup;

use Omoikane\Observers\Events\MenuGroup\MenuGroupCreated;
use Omoikane\Observers\Events\MenuGroup\MenuGroupDeleted;
use Omoikane\Observers\Events\MenuGroup\MenuGroupUpdated;
use Omoikane\Repositories\Contracts\MenuGroupRepository;
use Omoikane\Services\MenuGroup\Contracts\MenuGroupCrud as MenuGroupContract;

class MenuGroupCrud implements MenuGroupContract {

    protected $menuGroupRepository;

    public function __construct(MenuGroupRepository $menuGroupRepository)
    {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    public function create($name, array $members = [])
    {
        $create = $this->menuGroupRepository->create($name);

        if ($create) {
            event(New MenuGroupCreated($create, $members));
            return $create;
        }

        return false;
    }

    public function update($menuGroupId, $name, array $members = [])
    {
        $update = $this->menuGroupRepository->update($menuGroupId, $name);

        if ($update) {
            event(New MenuGroupUpdated($update, $members));
            return $update;
        }

        return false;
    }

    public function delete($id)
    {
        $delete = $this->menuGroupRepository->delete($id);

        if ($delete) {
            event(new MenuGroupDeleted($delete));
            return $delete;
        }

        return false;
    }

}