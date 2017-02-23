<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 22/02/17
 * Time: 17:37
 */

namespace Omoikane\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class BaseAdminController extends Controller{

    public $pathView;

    public function __construct()
    {
        $this->pathView = 'omoikane::admin.'.config('omoikane.admin_theme').'.views.';
    }

}