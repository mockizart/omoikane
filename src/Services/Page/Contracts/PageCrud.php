<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 20:30
 */

namespace Omoikane\Services\Page\Contracts;


interface PageCrud {

    /**
     * Create new page and trigger event "Omoikane\Observers\Events\Page\PageCreated"
     *
     * @param $status
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function create($status, $title, $slug, $keyword = '', $body, $description = '');

    /**
     *  Update a page and trigger event "Omoikane\Observers\Events\Page\PageUpdated"
     *
     * @param $pageId
     * @param $status
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function update($pageId, $status, $title, $slug, $keyword = '', $body, $description = '');

    /**
     * Remove one or more pages and then trigger event "Omoikane\Observers\Events\Page\PageDeleted"
     *
     * @param array $id
     * @return mixed
     */
    public function delete(Array $id);
}