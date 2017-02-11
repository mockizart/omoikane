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

class MenuMember extends Model {

    protected $table = 'menu_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function menuGroup()
    {
        return $this->belongsTo('Omoikane\Models\MenuGroup', 'group_id', 'id');
    }
}