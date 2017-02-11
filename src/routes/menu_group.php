<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 29/01/17
 * Time: 19:26
 */

Route::group(['namespace' => 'Omoikane\Http\Controllers\Admin', 'middleware' => ['web', 'auth']], function()
{

    Route::get('blog/admin/menu-group', ['as' => 'indexMenuGroup', 'uses' => 'MenuGroupController@index']);

    Route::get('blog/admin/menu-group/create', ['as' => 'createMenuGroup', 'uses' => 'MenuGroupController@create']);
    Route::post('blog/admin/menu-group/create', ['as' => 'saveMenuGroup', 'uses' => 'MenuGroupController@store']);

    Route::get('blog/admin/menu-group/edit/{id}', ['as' => 'editMenuGroup', 'uses' => 'MenuGroupController@edit']);
    Route::put('blog/admin/menu-group/edit/{id}', ['as' => 'updateMenuGroup', 'uses' => 'MenuGroupController@update']);

    Route::delete('blog/admin/menu-group/delete/{id}', ['as' => 'deleteMenuGroup', 'uses' => 'MenuGroupController@destroy']);

});