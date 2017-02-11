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

abstract class BasePostRepository implements \Omoikane\Repositories\Contracts\BasePostRepository{

    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    public function findPostById($id)
    {
        return $this->model->find($id);
    }

    public function pagination($keyword, $limit, $orderBy, $order)
    {
        $data = $this->model
            ->whereRaw("title like ?", ["%".$keyword."%"]);

        if ($orderBy=='name') {
            $this->getModel()->user('name', $order);
        } else {
            $data->orderBy($orderBy, $order);
        }

        return $data->paginate($limit);
    }

    public function delete(Array $id)
    {
        $data = $this->model->whereIn('id', $id);
        $cacheDeletedPost = $data->get();
        $delete = $data->delete();

        if ($delete) {
            return $cacheDeletedPost;
        }

        return false;
    }

}