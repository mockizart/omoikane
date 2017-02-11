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


interface MenuMemberRepository {

    public function create($groupId, $parentId, $name, $target);

    public function update($groupId = '',  $parentId = '', $menuMemberId, $name='', $target='');

}