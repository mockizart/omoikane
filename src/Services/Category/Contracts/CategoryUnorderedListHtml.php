<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 07/02/17
 * Time: 0:59
 */

namespace Omoikane\Services\Category\Contracts;


interface CategoryUnorderedListHtml {

    /**
     * Set available options delete, edit or checkbox to display for each category
     *
     * @param $options
     * @return mixed
     */
    public function setAvailableOptions($options);

    /**
     * Set checked category (make you sure you set available options for checkbox.
     * Example: setAvailableOptions(["checkbox"]);
     *
     * @param array $id
     * @return mixed
     */
    public function setCheckedCategory(Array $id);

    /**
     * show the li of each items
     *
     * @return mixed
     */
    public function current();

}