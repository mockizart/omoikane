<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 16:38
 */

namespace Omoikane\Observers\Events\Tag;


use Illuminate\Database\Eloquent\Collection;

class TagDeleted {

    public $tag = [];

    public function __construct(Collection $tags)
    {
        $this->tag = $tags;
    }

}