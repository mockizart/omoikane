<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:51
 */

namespace Omoikane\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model {

    protected $table = 'menu_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function menuMember()
    {
        return $this->hasMany('Omoikane\Models\MenuMember', 'group_id', 'id');
    }

}