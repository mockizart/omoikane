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

    Route::get('blog/admin/tag', ['as' => 'indexTag', 'uses' => 'TagController@index']);

    Route::get('blog/admin/tag/autocomplete', ['as' => 'autocompleteTag', 'uses' => 'TagController@autoComplete']);

    Route::get('blog/admin/tag/create', ['as' => 'createTag', 'uses' => 'TagController@create']);
    Route::post('blog/admin/tag/create', ['as' => 'saveTag', 'uses' => 'TagController@store']);

    Route::get('blog/admin/tag/edit/{id}', ['as' => 'editTag', 'uses' => 'TagController@edit']);
    Route::put('blog/admin/tag/edit/{id}', ['as' => 'updateTag', 'uses' => 'TagController@update']);

    Route::delete('blog/admin/tag/delete/{id}', ['as' => 'deleteTag', 'uses' => 'TagController@destroy']);

});