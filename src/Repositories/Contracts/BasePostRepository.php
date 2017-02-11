<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 20:20
 */

namespace Omoikane\Repositories\Contracts;


interface BasePostRepository {

//    public function save($userId, $title, $slug, $keyword, $body, $description);
//
//    public function update($postId, $userId, $title, $slug, $keyword, $body, $description);

    public function delete(Array $id);

}