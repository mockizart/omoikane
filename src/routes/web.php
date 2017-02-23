<?php


Route::group(['namespace' => 'Omoikane\Http\Controllers\Frontend', 'middleware' => ['web']], function()
{
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

});