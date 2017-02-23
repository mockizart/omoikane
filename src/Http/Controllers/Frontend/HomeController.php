<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 23/02/17
 * Time: 13:53
 */

namespace Omoikane\Http\Controllers\Frontend;


class HomeController extends FrontendBaseController{

    public function index()
    {
        $dataToView = [];
        return view('omoikane::article.frontend.view', $dataToView);
    }

}