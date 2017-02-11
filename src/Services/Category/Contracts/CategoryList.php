<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 9:49
 */

namespace Omoikane\Services\Category\Contracts;


interface CategoryList {

    /**
     * Set parent id of category you are going to list
     *
     * @param $id
     * @return mixed
     */
    public function setParentId($id);

}