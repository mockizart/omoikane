<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 17:56
 */

namespace Omoikane\Services\Tag;

use Omoikane\Repositories\Contracts\TagRepository;
use Omoikane\Services\AbstractPaginatedPost;
use Omoikane\Services\Tag\Contracts\PaginatedTag as PaginatedTagContract;

class PaginatedTag extends AbstractPaginatedPost implements PaginatedTagContract{

    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function paginatedData($limit = 20)
    {
        $path = $this->generatePaginatedPath();
        $data = $this->tagRepository->paginateTag($this->keyword, $path, $limit, $this->orderBy, $this->order);

        return $data;
    }

}