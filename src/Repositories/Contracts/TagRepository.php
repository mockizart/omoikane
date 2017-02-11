<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:55
 */

namespace Omoikane\Repositories\Contracts;


interface TagRepository extends BasePostRepository{

    /**
     * Find a tag by ID
     *
     * @param $id
     * @return mixed
     */
    public function findTagById($id);

    /**
     * Find Tag by slug
     *
     * @param $slug
     * @return mixed
     */
    public function findTagBySlug($slug);

    /**
     * Create new tag
     *
     * @param $userId
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function create($userId, $title, $slug, $keyword = '', $body, $description = '');

    /**
     * Update tag
     *
     * @param $tagId
     * @param string $title
     * @param string $slug
     * @param string $keyword
     * @param string $body
     * @param string $description
     * @return mixed
     */
    public function update($tagId, $title = '', $slug = '', $keyword = '', $body = '', $description = '');

    /**
     * Increase or decrease article counter
     *
     * @param array $id
     * @param bool $increase
     * @return mixed
     */
    public function articleCounter(Array $id, $increase = true);
}