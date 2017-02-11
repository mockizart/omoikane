<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 09/02/17
 * Time: 8:36
 */

namespace Omoikane\Services\MenuMember;

use Omoikane\Services\MenuMember\Contracts\MenuMemberArrayRecursive as Contract;

class MenuMemberArrayRecursive implements \RecursiveIterator, Contract{

    protected $data;

    protected $counter = 0;

    public function __construct(array $menuMembers)
    {
        $this->data = $menuMembers;
    }

    public function hasChildren()
    {
        return (isset($this->data[$this->key()]['children']));
    }

    public function getChildren()
    {
        $current = $this->current();
        $data = new MenuMemberArrayRecursive($current['children']);

        return $data;
    }

    public function current()
    {
        return $this->data[$this->key()];
    }

    public function key()
    {
        return $this->counter;
    }

    public function next()
    {
        return $this->counter++;
    }

    public function valid()
    {
        return $this->counter < count($this->data);
    }

    public function rewind()
    {
        $this->counter = 0;
    }

}