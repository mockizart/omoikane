<?php
/**
 * Updated by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 09/02/17
 * Time: 16:15
 */

namespace Omoikane\Observers\Events\MenuGroup;


use Omoikane\Models\MenuGroup;

class MenuGroupDeleted {

    public $menuGroup;

    public $menuMembers;

    public function __construct(MenuGroup $menuGroup)
    {
        $this->menuGroup = $menuGroup;
    }

}