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


use Omoikane\Observers\Events\MenuGroup\MenuGroupUpdated;
use Omoikane\Services\MenuMember\Contracts\MenuMemberCrud;

class UpdateMenuMember {

    protected $menuMemberCrud;

    public function __construct(MenuMemberCrud $menuMemberCrud)
    {
        $this->menuMemberCrud = $menuMemberCrud;
    }

    public function handle(MenuGroupUpdated $menuGroupUpdated)
    {
        $this->menuMemberCrud->update($menuGroupUpdated->menuGroup, $menuGroupUpdated->menuMembers);
    }

}