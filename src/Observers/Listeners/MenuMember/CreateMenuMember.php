<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 09/02/17
 * Time: 16:22
 */

namespace Omoikane\Observers\Listeners\MenuMember;


use Omoikane\Observers\Events\MenuGroup\MenuGroupCreated;
use Omoikane\Services\MenuMember\Contracts\MenuMemberCrud;

class CreateMenuMember {

    protected $menuMemberCrud;

    public function __construct(MenuMemberCrud $menuMemberCrud)
    {
        $this->menuMemberCrud = $menuMemberCrud;
    }

    public function handle(MenuGroupCreated $menuGroupCreated)
    {
        $this->menuMemberCrud->create($menuGroupCreated->menuGroup, $menuGroupCreated->menuMembers);
    }

}