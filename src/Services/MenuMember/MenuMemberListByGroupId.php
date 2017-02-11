<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 09/02/17
 * Time: 22:33
 */

namespace Omoikane\Services\MenuMember;

use Omoikane\Repositories\MenuMemberRepository;
use Omoikane\Services\MenuMember\Contracts\MenuMemberListByGroupId as Contract;

class MenuMemberListByGroupId implements \RecursiveIterator, Contract{
    
    protected $menuMemberRepository;

    protected $menuMembers;

    protected $counter = 0;

    protected $parentId;

    protected $groupId;

    protected $dataArrayKeyParent;

    public function __construct(MenuMemberRepository $menuMemberRepository)
    {
        $this->menuMemberRepository = $menuMemberRepository;
    }

    public function setParentId($id)
    {
        $this->parentId = $id;
    }

    protected function setDataArrayKeyParent($parent)
    {
        $this->dataArrayKeyParent = $parent;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    public function getMenuMembers($parentId = 0)
    {
        $this->menuMembers = $this->menuMemberRepository->getMenuMemberByParentAndGroupId(
            $this->groupId,
            $parentId
        );
    }

    public function hasChildren()
    {
        $has = $this->menuMemberRepository->getMenuMemberByParentAndGroupId(
            $this->groupId,
            $this->current()->id
        )->count();

        return $has;
    }

    public function getChildren()
    {
        $children = new MenuMemberListByGroupId($this->menuMemberRepository);
        $children->setParentId($this->current()->id);
        $children->setGroupId($this->groupId);
        $children->setDataArrayKeyParent($this->current()->dataArrayKey);
        return $children;
    }

    public function current()
    {
        $data = $this->menuMembers[$this->counter];

        if (!$this->dataArrayKeyParent) {
            $data->dataArrayKey = '[' . $this->counter . ']';
        } else {
            $data->dataArrayKey = $this->dataArrayKeyParent . '[children]['.$this->counter.']';
        }


        return $data;
    }

    public function key ()
    {
        return $this->counter;
    }
    public function next ()
    {
        return $this->counter++;
    }

    public function rewind ()
    {
        $this->getMenuMembers($this->parentId);

        return $this->counter = 0;
    }
    public function valid ()
    {
        return $this->counter < count($this->menuMembers);
    }

}