<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 03/02/17
 * Time: 19:10
 */

namespace Omoikane\Services;


use Omoikane\Services\Contracts\PaginatedPost;

abstract class AbstractPaginatedPost implements PaginatedPost{

    protected $allowedOrderBy = ['id', 'view', 'name', 'title'];

    protected $allowedOrder = ['asc', 'desc'];

    protected $keyword;

    protected $orderBy = 'id';

    protected $order = 'desc';


    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function setOrderBy($orderBy = 'id', $order = 'desc')
    {
        $this->orderBy = (in_array($orderBy, $this->allowedOrderBy)) ? $orderBy : 'id';
        $this->order = (in_array($order, $this->allowedOrder)) ? $order : 'desc';

        return $this;
    }

    protected function generatePaginatePath()
    {
        $path   = [];
        $path[] =  (!$this->keyword)?: 'q='.$this->keyword;
        $path[] =  (!$this->orderBy)?: 'orderby='.$this->orderBy;
        $path[] =  (!$this->order)?: 'order='.$this->order;
        $path   = array_diff($path, [true]);

        return '?'.implode('&', $path);
    }

    abstract function paginatedData($limit = 20);

}