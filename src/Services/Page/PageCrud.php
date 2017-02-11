<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 20:30
 */

namespace Omoikane\Services\Page;

use Omoikane\Observers\Events\Page\PageCreated;
use Omoikane\Observers\Events\Page\PageDeleted;
use Omoikane\Observers\Events\Page\PageUpdated;
use Omoikane\Repositories\Contracts\PageRepository;
use Omoikane\Services\Page\Contracts\PageCrud as PageCrudContract;
use Auth;

class PageCrud implements PageCrudContract {

    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function create($status, $title, $slug, $keyword = '', $body, $description = '')
    {
        $save = $this->pageRepository->addPage(
            Auth::id(),
            $status,
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        if ($save) {
            event(new PageCreated($save));
            return $save;
        }

        return false;
    }

    public function update($pageId, $status, $title, $slug, $keyword = '', $body, $description = '')
    {
        $updated = $this->pageRepository->updatePage(
            $pageId,
            $status,
            $title,
            $slug,
            $keyword,
            $body,
            $description
        );

        if ($updated) {
            event(new PageUpdated($updated));
            return $updated;
        }

        return false;
    }

    public function delete(Array $id)
    {
        $deleted = $this->pageRepository->deletePage($id);

        if ($deleted) {
            event(new PageDeleted($deleted));
            return $deleted;
        }

        return false;
    }

}