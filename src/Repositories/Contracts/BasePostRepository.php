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

    /**
     * Find a post by slug
     *
     * @param $slug
     * @return mixed
     */
    public function findPostBySlug($slug);

    /**
     * Get paginated data post
     *
     * @param $keyword
     * @param $limit
     * @param $orderBy
     * @param $order
     * @return mixed
     */
    public function pagination($keyword, $limit, $orderBy, $order);

}