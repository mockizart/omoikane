<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 11/02/17
 * Time: 16:31
 */

namespace Omoikane\Repositories;

use Omoikane\Repositories\Contracts\BaseRepository as Contract;

class BaseRepository implements Contract{

    protected $model;

    public function getNewModel()
    {
        return new $this->model;
    }

    public function findById($id)
    {
       return $this->model->find($id);
    }

    public function findByField($fieldName, $value)
    {
        return $this->model->where($fieldName, $value);
    }

    public function findWhereLike($field, $value)
    {
        return $this->model->whereRaw($field . ' like ?', $value)->get();
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