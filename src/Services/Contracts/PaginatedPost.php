<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 19:19
 */

namespace Omoikane\Services\Contracts;


interface PaginatedPost {

    public function setKeyword($keyword);

    public function setOrderBy($orderBy = 'id', $order = 'desc');

    public function paginatedData($limit = 20);

}