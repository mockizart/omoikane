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


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use Sluggable;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'parent_id', 'slug', 'meta_keyword', 'body', 'meta_description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    public function user($orderBy = 'name', $order= 'desc')
    {
        return $this->belongsTo('Omoikane\Models\User', 'user_id', 'id')->orderBy($orderBy, $order);
    }


    public function article()
    {
        return $this->belongsToMany('Omoikane\Models\Article');
    }
}