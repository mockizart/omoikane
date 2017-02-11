<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 05/02/17
 * Time: 9:49
 */

namespace Omoikane\Validations;

use Omoikane\Validations\Contracts\MenuGroupValidation as MenuGroupValidationContract;

class MenuGroupValidation implements MenuGroupValidationContract {

    public $rules = [
        'name' => 'required|max:50',
    ];

}