<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 07/02/17
 * Time: 11:57
 */

namespace Omoikane\Repositories;

use Omoikane\Models\MenuGroup;
use Omoikane\Repositories\Contracts\MenuGroupRepository as MenuGroupContract;

class MenuGroupRepository extends BaseRepository implements MenuGroupContract {

    protected $model;

    public function __construct(MenuGroup $menuGroup)
    {
        $this->model = $menuGroup;
    }

    public function findMenuGroupById($id)
    {
        return $this->model->find($id);
    }

    public function addMenuGroup($name)
    {
        $data = $this->getNewModel();

        $data->name = $name;

        return ($data->save())  ? $data : false;
    }

    public function updateMenuGroup($menuGroupId, $name)
    {
        $data = $this->findMenuGroupById($menuGroupId);

        $data->name = $name;

        return ($data->save()) ? $data : false;
    }

    public function paginateMenuGroup($keyword, $path, $limit, $orderBy, $order)
    {
        $data = $this->model
            ->whereRaw("name like ?", ["%".$keyword."%"]);

        $data->orderBy($orderBy, $order);

        return $data->paginate($limit)->withPath($path);
    }

    public function deleteMenuGroup($id)
    {
        $data = $this->findMenuGroupById($id);

        return ($data->delete()) ? $data : false;
    }

}