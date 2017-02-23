<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 23/02/17
 * Time: 11:17
 */

namespace Omoikane\Observers\Listeners;


use Omoikane\Services\Contracts\Pingomatic;

class Ping {

    protected $pingomatic;

    public function __construct(Pingomatic $pingomatic)
    {
        $this->pingomatic = $pingomatic;
    }

    public function handle()
    {
        $this->pingomatic->ping();
    }

}