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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);

    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');

    Route::get('/auth/facebook', ['as' => 'auth.facebook', 'uses' => 'AuthController@getFacebook']);

    // password controller
    Route::controller('password', 'PasswordController');

    Route::controller('vote', 'VoteController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::get('custom_code', ['as' => 'admin.custom_code', 'uses' => 'DashboardController@custom_code']);
    Route::post('custom_css', 'DashboardController@updateCustomCss');
    Route::post('custom_js', 'DashboardController@updateCustomJs');
    Route::get('settings', ['as' => 'admin.settings', 'uses' => 'DashboardController@settings']);
    Route::post('settings', 'DashboardController@update_settings');

    Route::get('dashboard', 'DashboardController@dashboard');

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

    Route::controller('dashboard', 'DashboardController');
});

Route::group(['namespace' => 'Frontend'], function () {

    # homepage
    Route::get('/', ['as' => 'HomePage', 'uses' => 'HomeController@getIndex']);
    Route::post('/', ['as' => 'HomePage', 'uses' => 'HomeController@getIndex']);

    # upload
//    Route::get('upload', ['as' => 'post.new', 'uses' => 'PostsController@getUpload']);

    Route::group(['prefix' => 'post'], function () {
        Route::get('random', ['as' => 'post.random', 'uses' => 'PostsController@random']);
        Route::get('{code}', ['as' => 'post.details', 'uses' => 'PostsController@getDetails']);
        Route::get('add-a-fun', ['as' => 'post.add', 'uses' => 'PostsController@getAdd']);
        Route::post('add-a-fun', 'PostsController@postAdd');
    });

    Route::controller('medias', 'MediasController', [

    ]);

    Route::get('crawler', 'CrawlerController@getCrawler');
    Route::post('crawler', 'CrawlerController@postCrawler');

    Route::group(['prefix' => 'users'], function () {
        Route::post('top_sidebar', 'UsersController@topSideBar');
    });
});