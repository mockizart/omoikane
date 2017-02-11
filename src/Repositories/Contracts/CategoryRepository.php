<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 01/02/17
 * Time: 8:07
 */

namespace Omoikane\Repositories\Contracts;


interface CategoryRepository {

    /**
     * Create a category
     *
     * @param $userId
     * @param $parentId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function create($userId, $parentId, $title, $slug, $keyword, $body, $description);

    /**
     * Update category
     *
     * @param $pageId
     * @param $parentId
     * @param $title
     * @param $slug
     * @param $keyword
     * @param $body
     * @param $description
     * @return mixed
     */
    public function update($pageId, $parentId, $title, $slug, $keyword, $body, $description);

    /**
     * Delete one or more categories
     *
     * @param array $id
     * @return mixed
     */
    public function delete(Array $id);

    /**
     * Find a category by id
     *
     * @param $id
     * @return mixed
     */
    public function findCategoryById($id);

    /**
     * Find a category by slug
     *
     * @param $slug
     * @return mixed
     */
    public function findCategoryBySlug($slug);

    /**
     * Get categories by parent id.
     *
     * @param int $parentId
     * @return mixed
     */
    public function getCategories($parentId = 0);

    /**
     * Increase or decrease the number of article in a category.
     *
     * @param array $id
     * @param bool $increase
     * @return mixed
     */
    public function articleCounter(Array $id, $increase = true);
}