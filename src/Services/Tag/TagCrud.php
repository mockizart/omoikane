<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 20:30
 */

namespace Omoikane\Services\Tag;

use Omoikane\Observers\Events\Tag\TagCreated;
use Omoikane\Observers\Events\Tag\TagDeleted;
use Omoikane\Observers\Events\Tag\TagUpdated;
use Omoikane\Repositories\Contracts\TagRepository;
use Omoikane\Services\Tag\Contracts\TagCrud as TagCrudContract;
use Auth;

class TagCrud implements TagCrudContract {

    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function create($title, $slug, $keyword = '', $body, $description = '')
    {
        $save = $this->tagRepository->create(
            Auth::id(),
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        if ($save) {
            event(new TagCreated($save));
            return $save;
        }

        return false;
    }

    public function update($tagId, $title, $slug, $keyword = '', $body, $description = '')
    {
        $updated = $this->tagRepository->update(
            $tagId,
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        if ($updated) {
            event(new TagUpdated($updated));
            return $updated;
        }

        return false;
    }

    public function delete(Array $id)
    {
        $deleted = $this->tagRepository->delete($id);
        $cacheData = $deleted;

        if ($deleted) {
            event(new TagDeleted($cacheData));
            return $deleted;
        }

        return false;
    }

}