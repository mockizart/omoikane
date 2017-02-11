<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 1:11
 */

namespace Omoikane\Services\Category\Contracts;


interface CategoryCrud {

    /**
     * Service to create new category
     *
     * @param $parentId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function create($parentId, $title, $slug, $keyword, $body, $description);

    /**
     *
     * Service to update category
     *
     * @param $categoryId
     * @param $parentId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function update($categoryId, $parentId, $title, $slug, $keyword, $body, $description);

    /**
     * Service to delete category and its descendants
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

}