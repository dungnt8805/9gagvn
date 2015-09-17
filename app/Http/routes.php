<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::controller('categories', 'CategoriesController', [
        'getIndex' => 'admin.categories.index',
        'getView' => 'admin.categories.view'
    ]);
    Route::controller('stores', 'StoresController', [
        'getIndex' => 'admin.stores.index',
        'getView' => 'admin.stores.view'
    ]);
    Route::controller('posts', 'PostsController', [
        'getIndex' => 'admin.posts.index',
        'getCreate' => 'admin.posts.add'
    ]);
});

Route::group(['namespace' => 'Frontend'], function () {

    # homepage
    Route::get('/', ['as' => 'HomePage', 'uses' => 'HomeController@getIndex']);

    Route::group(['prefix' => 'post'], function () {
        Route::get('{code}', ['as' => 'post.details', 'uses' => 'PostsController@getDetails']);

        Route::get('add', ['as' => 'post.add', 'uses' => 'PostsController@getAdd']);

    });

    Route::controller('medias', 'MediasController', [

    ]);
});