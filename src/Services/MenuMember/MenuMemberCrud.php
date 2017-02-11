<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 07/02/17
 * Time: 12:08
 */

namespace Omoikane\Services\MenuMember;

use Omoikane\Repositories\Contracts\MenuMemberRepository;
use Omoikane\Services\MenuMember\Contracts\MenuMemberCrud as MenuMemberContract;

class MenuMemberCrud implements MenuMemberContract {

    protected $menuMemberRepository;

    protected $menuMemberArrayRecursive;

    public function __construct(
        MenuMemberRepository $menuMemberRepository
    )
    {
        $this->menuMemberRepository = $menuMemberRepository;
    }

    public function create($menuGroupId, array $data)
    {
        $members = new MenuMemberArrayRecursive($data);
        $memberRec = new \RecursiveIteratorIterator($members, \RecursiveIteratorIterator::SELF_FIRST);

        $parentId = [];
        foreach ($memberRec as $member) {

            $parent = (isset($parentId[$memberRec->getDepth()])) ? $parentId[$memberRec->getDepth()] : 0;
            $create = $this->menuMemberRepository->create(
                $menuGroupId->id,
                $parent,
                $member['title'],
                $member['target'],
                $member['type']
            );

            $parentId[$memberRec->getDepth() + 1] = ($memberRec->hasChildren()) ? $create->id : 0;
        }

    }

    public function update($menuGroupId, array $data)
    {
        $this->menuMemberRepository->deleteByGroupId($menuGroupId->id);
        $this->create($menuGroupId, $data);
    }

    public function deleteByGroupId($groupId)
    {
        $delete = $this->menuMemberRepository->deleteByGroupId($groupId);

        return $delete;
    }

}