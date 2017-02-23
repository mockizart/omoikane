<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 23/02/17
 * Time: 10:54
 */

namespace Omoikane\Services;

use Illuminate\Http\Request;
use Omoikane\Services\Contracts\Pingomatic as Contract;
use Illuminate\Contracts\Routing\UrlGenerator;

class Pingomatic implements Contract {

    protected $url;

    protected $request;

    public function __construct(Request $request, UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
        $this->request = $request;
    }

    public function ping()
    {
        $check = $this->checkLastPing();

        if ($check>86400)
        {
            $url = 'http://pingomatic.com/ping/?title='.config('omoikane.pingomatic_title');
            $url .= '&blogurl='.$this->url->to('/');
            $url .= '&rssurl=http%3A%2F%2F&chk_weblogscom=on&chk_blogs=on&chk_feedburner=on&chk_newsgator=on&chk_myyahoo=on&chk_pubsubcom=on&chk_blogdigger=on&chk_weblogalot=on&chk_newsisfree=on&chk_topicexchange=on&chk_google=on&chk_tailrank=on&chk_skygrid=on&chk_collecta=on&chk_superfeedr=on';

            $remote = fopen($url, "rb");

            $this->request->session()->put('pingomatic_last_ping', time());
        }
    }

    protected function checkLastPing()
    {
        $lastPing = $this->request->session()->get('pingomatic_last_ping');
        $diff = $lastPing - time();

        return $diff;
    }

}