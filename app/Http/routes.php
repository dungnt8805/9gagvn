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
Route::pattern('code', '[a-zA-Z0-9]+');

Route::group(['namespace'=>'Auth'],function(){
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
    
    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');
    
    Route::get('/auth/facebook',['as'=>'auth.facebook','uses'=>'AuthController@getFacebook']);
});

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

        Route::get('add-a-fun', ['as' => 'post.add', 'uses' => 'PostsController@getAdd']);
        Route::post('add-a-fun','PostsController@postAdd');
    });

    Route::controller('medias', 'MediasController', [

    ]);
    
    
    
});