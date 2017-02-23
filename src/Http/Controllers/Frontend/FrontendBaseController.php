<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 23/02/17
 * Time: 14:04
 */

namespace Omoikane\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;

class FrontendBaseController extends Controller{

    protected $dataToView = [];

    protected $pathToView;

    public function __construct()
    {
//        $this->pathToView = 'omoikane::article.frontend.view';
    }

}