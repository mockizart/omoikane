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

class ArticleTag extends Model {

    protected $table = 'article_tag';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'category_id'];

    public function article()
    {
        return $this->belongsTo('Omoikane\Models\Article');
    }

    public function tag()
    {
        return $this->belongsTo('Omoikane\Models\Tag');
    }

}