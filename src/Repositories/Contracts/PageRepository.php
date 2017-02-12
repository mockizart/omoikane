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


interface PageRepository extends BasePostRepository{

    /**
     * Find a page by id
     *
     * @param $id
     * @return mixed
     */
    public function findPageById($id);

    /**
     * Find a page by slug
     *
     * @param $slug
     * @return mixed
     */
    public function findPageBySlug($slug);

    /**
     * Create new page
     *
     * @param $userId
     * @param int $status
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function addPage($userId, $status = 0, $title, $slug, $keyword = '', $body, $description = '');

    /**
     * Update a page
     *
     * @param $pageId
     * @param string $status
     * @param string $title
     * @param string $slug
     * @param string $keyword
     * @param string $body
     * @param string $description
     * @return mixed
     */
    public function updatePage($pageId, $status = '', $title = '', $slug = '', $keyword = '', $body = '', $description = '');

    /**
     * Delete a page
     *
     * @param array $id
     * @return mixed
     */
    public function deletePage(array $id);

    /**
     * get paginated page
     *
     * @param $keyword
     * @param $path
     * @param $limit
     * @param $orderBy
     * @param $order
     * @return mixed
     */
    public function paginatePage($keyword, $path, $limit, $orderBy, $order);

    /**
     * Find a page title like
     *
     * @param $keyword
     * @return mixed
     */
    public function findPageTitleLike($keyword);
}