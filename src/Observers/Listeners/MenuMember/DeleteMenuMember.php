<?php
/**
 * Updated by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 09/02/17
 * Time: 16:22
 */

namespace Omoikane\Observers\Listeners\MenuMember;


use Omoikane\Observers\Events\MenuGroup\MenuGroupDeleted;
use Omoikane\Services\MenuMember\Contracts\MenuMemberCrud;

class DeleteMenuMember {

    protected $menuMemberCrud;

    public function __construct(MenuMemberCrud $menuMemberCrud)
    {
        $this->menuMemberCrud = $menuMemberCrud;
    }

    public function handle(MenuGroupDeleted $menuGroupDeleted)
    {
        $this->menuMemberCrud->deleteByGroupId($menuGroupDeleted->menuGroup->id);
    }
}