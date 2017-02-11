<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 11/02/17
 * Time: 16:29
 */

namespace Omoikane\Repositories\Contracts;


interface BaseRepository {

    /**
     * Get the new object of model or entity
     *
     * @return mixed
     */
    public function getNewModel();

    /**
     * get a record from specific field as the condition.
     *
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findByField($fieldName, $value);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param array $id
     * @return mixed
     */
    public function delete(Array $id);

    /**
     * Find with where like query
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findWhereLike($field, $value);

}