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

    Route::get('blog/admin/article', ['as' => 'indexArticle', 'uses' => 'ArticleController@index']);

    Route::get('blog/admin/article/autocomplete', ['as' => 'autocompleteArticle', 'uses' => 'ArticleController@autoComplete']);


    Route::get('blog/admin/article/create', ['as' => 'createArticle', 'uses' => 'ArticleController@create']);
    Route::post('blog/admin//article/create', ['as' => 'saveArticle', 'uses' => 'ArticleController@store']);

    Route::get('blog/admin/article/edit/{id}', ['as' => 'editArticle', 'uses' => 'ArticleController@edit']);
    Route::put('blog/admin/article/edit/{id}', ['as' => 'updateArticle', 'uses' => 'ArticleController@update']);

    Route::delete('blog/admin/article/delete/{id}', ['as' => 'deleteArticle', 'uses' => 'ArticleController@destroy']);

});



Route::group(['namespace' => 'Omoikane\Http\Controllers\Frontend', 'middleware' => ['web']], function()
{
    Route::get('blog/article/', ['as' => 'frontendIndexArticle', 'uses' => 'ArticleController@index']);
    Route::get('blog/article/{slug}', ['as' => 'frontendViewArticle', 'uses' => 'ArticleController@view']);
    Route::get('blog/sitemap/article/', ['as' => 'frontendSitemapArticle', 'uses' => 'ArticleController@sitemap']);

});