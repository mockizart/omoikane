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

    Route::get('blog/admin/category', ['as' => 'indexCategory', 'uses' => 'CategoryController@index']);

    Route::get('blog/admin/category/autocomplete', ['as' => 'autocompleteCategory', 'uses' => 'CategoryController@autoComplete']);

    Route::get('blog/admin/category/create', ['as' => 'createCategory', 'uses' => 'CategoryController@create']);
    Route::post('blog/admin/category/create', ['as' => 'saveCategory', 'uses' => 'CategoryController@store']);

    Route::get('blog/admin/category/edit/{id}', ['as' => 'editCategory', 'uses' => 'CategoryController@edit']);
    Route::put('blog/admin/category/edit/{id}', ['as' => 'updateCategory', 'uses' => 'CategoryController@update']);

    Route::delete('blog/admin/category/delete/{id}', ['as' => 'deleteCategory', 'uses' => 'CategoryController@destroy']);

});