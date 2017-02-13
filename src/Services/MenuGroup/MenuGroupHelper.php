<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 12/02/17
 * Time: 14:19
 */

namespace Omoikane\Services\MenuGroup;


use IteratorIterator;
use Omoikane\Repositories\Contracts\MenuGroupRepository;
use Omoikane\Services\MenuMember\MenuMemberListByGroupId;

class MenuGroupHelper {

    protected $menuGroupRepository;

    protected $menuMemberListByGroupId;

    public function __construct(
        MenuGroupRepository $menuGroupRepository,
        MenuMemberListByGroupId $menuMemberListByGroupId
    )
    {
        $this->menuGroupRepository = $menuGroupRepository;
        $this->menuMemberListByGroupId = $menuMemberListByGroupId;
    }

    public function getMenuMembers($groupId)
    {
        $this->menuMemberListByGroupId->setParentId(0);
        $this->menuMemberListByGroupId->setGroupId($groupId);
        $this->menuMemberListByGroupId->setTranslateTarget(true);

        $menuMembers = new IteratorIterator(
            $this->menuMemberListByGroupId,
            \RecursiveIteratorIterator::SELF_FIRST
        );

        return $menuMembers;
    }

    public function getMenuMemberUnorderedList($groupId)
    {
//        $menuMembers = $this->menuMemberListByGroupId;
//        $menuMembers->setGroupId($groupId);
//        $menuMembers->setParentId(0);
//        $menuMembers = new MenuMemberUnorderedListHtml(
//            $menuMembers
//        );
//
//        $menuMembers->setAvailableOptions(['edit', 'delete']);
//        $menuMembers->setCheckedMenuMember($checked);
//
//        return $menuMembers;
    }

}