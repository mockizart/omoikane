<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 20:04
 */

namespace Omoikane\Validations;

use Omoikane\Validations\Contracts\PageValidation as PageValidationContract;

class PageValidation implements PageValidationContract{

    public $rules = [
        'title' => 'required|max:150',
        'body' => 'required',
    ];

}