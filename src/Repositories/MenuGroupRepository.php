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

class MenuGroupRepository implements MenuGroupContract {

    protected $model;

    public function __construct(MenuGroup $menuGroup)
    {
        $this->model = $menuGroup;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function findMenuGroupById($id)
    {
        return $this->model->find($id);
    }

    public function create($name)
    {
        $this->model->name = $name;

        return ($this->model->save())  ? $this->model : false;
    }

    public function update($menuGroupId, $name)
    {
        $data = $this->findMenuGroupById($menuGroupId);

        $data->name = $name;

        return ($data->save()) ? $data : false;
    }

    public function pagination($keyword, $limit, $orderBy, $order)
    {
        $data = $this->model
            ->whereRaw("name like ?", ["%".$keyword."%"]);

        $data->orderBy($orderBy, $order);

        return $data->paginate($limit);
    }

    public function delete($id)
    {
        $data = $this->findMenuGroupById($id);

        return ($data->delete()) ? $data : false;
    }

}