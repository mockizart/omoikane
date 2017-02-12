<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 07/02/17
 * Time: 11:56
 */

namespace Omoikane\Repositories\Contracts;


interface MenuGroupRepository {

    /**
     * Find menu group by id
     *
     * @param $id
     * @return mixed
     */
    public function findMenuGroupById($id);

    /**
     * Add menu group
     *
     * @param $name
     * @return mixed
     */
    public function addMenuGroup($name);

    /**
     * Update menu group
     *
     * @param $menuGroupId
     * @param $name
     * @return mixed
     */
    public function updateMenuGroup($menuGroupId, $name);

    /**
     * get paginated menu group
     *
     * @param $keyword
     * @param $path
     * @param $limit
     * @param $orderBy
     * @param $order
     * @return mixed
     */
    public function paginateMenuGroup($keyword, $path, $limit, $orderBy, $order);

    /**
     * Delete menu group
     *
     * @param $id
     * @return mixed
     */
    public function deleteMenuGroup($id);

}