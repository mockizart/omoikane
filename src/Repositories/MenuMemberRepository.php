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

use Omoikane\Models\MenuMember;
use Omoikane\Repositories\Contracts\MenuMemberRepository as MenuMemberContract;

class MenuMemberRepository implements MenuMemberContract {


    protected $model;

    public function __construct(MenuMember $menuMember)
    {
        $this->model = $menuMember;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getMenuMemberByParentAndGroupId($groupId, $parentId)
    {
        $data = $this->model->whereRaw('group_id = ? AND parent_id = ?', [$groupId, $parentId]);

        return $data->get();
    }

    public function deleteByGroupId($groupId)
    {
        $data = $this->model->where('group_id', $groupId);

        return ($data->delete()) ? $data : false;
    }

    public function create($groupId, $parentId, $name, $target, $type=0)
    {
        $data = new MenuMember();
        $data->name = $name;
        $data->target = $target;
        $data->group_id = $groupId;
        $data->parent_id = $parentId;
        $data->type = $type;

        return ($data->save()) ? $data : false;
    }

    public function update($groupId = '',  $parentId = '', $menuMemberId, $name='', $target='', $type=0)
    {
        $data = $this->findMenuMemberById($menuMemberId);

        $data->name = ($name) ? $name : $data->name;
        $data->target = ($target) ? $target : $data->target;
        $data->group_id = ($groupId) ? $groupId : $data->groupId;
        $data->parent_id = ($parentId) ? $parentId : $data->parentId;
        $data->type = ($type) ? $type : $data->type;

        return ($data->save()) ? $data : false;
    }


}