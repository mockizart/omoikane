<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 19:47
 */

namespace Omoikane\Repositories;

use Omoikane\Repositories\Contracts\BasePostRepository as Contract;

abstract class BasePostRepository extends BaseRepository implements Contract {

    public function findPostTitleLike($keyword)
    {
        return $this->findWhereLike('title', '%' . $keyword . '%');
    }

    public function findPostBySlug($slug)
    {
        return $this->findByField('slug', $slug)->first();
    }

    public function pagination($keyword, $path, $limit, $orderBy, $order)
    {
        $data = $this->model
            ->whereRaw("title like ?", ["%".$keyword."%"]);

        if ($orderBy=='name') {
            $this->getModel()->user('name', $order);
        } else {
            $data->orderBy($orderBy, $order);
        }

        return $data->paginate($limit)->withPath($path);
    }

}