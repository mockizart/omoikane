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

class Article extends Model {

    use Sluggable;

    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'meta_keyword', 'body', 'meta_description'];

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

    public function category()
    {
        return $this->hasMany('Omoikane\Models\ArticleCategory', 'article_id', 'id');
    }

    public function tag()
    {
        return $this->hasMany('Omoikane\Models\ArticleTag', 'article_id', 'id');
    }
}