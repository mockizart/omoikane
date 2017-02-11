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

use Omoikane\Validations\Contracts\ArticleValidation as ArticleValidationContract;

class ArticleValidation implements ArticleValidationContract {

    public $rules = [
        'title' => 'required|max:150',
        'body' => 'required',
    ];

}