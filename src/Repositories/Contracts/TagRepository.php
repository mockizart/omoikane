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
     * find most view tags default limit 10 tags
     *
     * @param int $limit
     * @return mixed
     */
    public function getMostViewedTags($limit = 10);

    /**
     * Find tags by Id
     *
     * @param array $id
     * @param bool $getResult
     * @return mixed
     */
    public function findTagsById(Array $id, $getResult = false);

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
    public function addTag($userId, $title, $slug, $keyword = '', $body, $description = '');

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
    public function updateTag($tagId, $title = '', $slug = '', $keyword = '', $body = '', $description = '');

    /**
     * Increase or decrease article counter
     *
     * @param array $id
     * @param bool $increase
     * @return mixed
     */
    public function articleCounter(Array $id, $increase = true);

    /**
     * Get paginated tag
     *
     * @param $keyword
     * @param $path
     * @param $limit
     * @param $orderBy
     * @param $order
     * @return mixed
     */
    public function paginateTag($keyword, $path, $limit, $orderBy, $order);

    /**
     * Delete one or more tags by id
     *
     * @param array $id
     * @return mixed
     */
    public function deleteTag(array $id);

    /**
     * Find tag title like
     *
     * @param $keyword
     * @return mixed
     */
    public function findTagTitleLike($keyword);
}