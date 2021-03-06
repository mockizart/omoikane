<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 16:38
 */

namespace Omoikane\Observers\Events\Page;


use Omoikane\Models\Page;

class PageUpdated {

    public $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

}