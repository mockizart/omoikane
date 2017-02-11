<?php

namespace Omoikane\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function category()
    {
        return $this->hasMany('Omoikane\Models\Category', 'user_id', 'id');
    }

    public function article()
    {
        return $this->hasMany('Omoikane\Models\Article', 'user_id', 'id');
    }

    public function page()
    {
        return $this->hasMany('Omoikane\Models\Page', 'user_id', 'id');
    }

    public function tag()
    {
        return $this->hasMany('Omoikane\Models\Tag', 'user_id', 'id');
    }
}
