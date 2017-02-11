<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 04/02/17
 * Time: 0:12
 */

namespace Omoikane\Services\Tag\Contracts;


interface TagCrud {

    /**
     * Create new tag and fire "TagCreated" event.
     *
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function create($title, $slug, $keyword = '', $body, $description = '');

    /**
     * Update tag and fire "TagUpdated" event.
     *
     * @param $tagId
     * @param $title
     * @param $slug
     * @param string $keyword
     * @param $body
     * @param string $description
     * @return mixed
     */
    public function update($tagId, $title, $slug, $keyword = '', $body, $description = '');

    /**
     * Delete tag and fire "TagDeleted" event.
     *
     * @param array $id
     * @return mixed
     */
    public function delete(Array $id);
}