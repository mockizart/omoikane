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


use Illuminate\Database\Eloquent\Collection;

class PageDeleted {

    public $pages = [];

    public function __construct(Collection $pages)
    {
        $this->pages = $pages;
    }

}