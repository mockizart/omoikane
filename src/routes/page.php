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

    Route::get('blog/admin/page', ['as' => 'indexPage', 'uses' => 'PageController@index']);

    Route::get('blog/admin/page/autocomplete', ['as' => 'autocompletePage', 'uses' => 'PageController@autoComplete']);

    Route::get('blog/admin/page/create', ['as' => 'createPage', 'uses' => 'PageController@create']);
    Route::post('blog/admin/page/create', ['as' => 'savePage', 'uses' => 'PageController@store']);

    Route::get('blog/admin/page/edit/{id}', ['as' => 'editPage', 'uses' => 'PageController@edit']);
    Route::put('blog/admin/page/edit/{id}', ['as' => 'updatePage', 'uses' => 'PageController@update']);

    Route::delete('blog/admin/page/delete/{id}', ['as' => 'deletePage', 'uses' => 'PageController@destroy']);

});


Route::group(['namespace' => 'Omoikane\Http\Controllers\Frontend'], function()
{
    Route::get('blog/page/{slug}', ['as' => 'frontendPage', 'uses' => 'PageController@index']);
});


