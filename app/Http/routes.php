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
Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\Auth'], function () {
    Route::post('/auth/register', 'AuthController@register');
    Route::post('/auth/login', 'AuthController@login');
    Route::get('/auth/user', 'AuthController@getAuthenticatedUser');

    // Password Reset Routes...
    // Route::post('/auth/password/email', 'PasswordResetController@sendResetLinkEmail');
    // Route::get('/auth/password/verify', 'PasswordResetController@verify');
    // Route::post('/auth/password/reset', 'PasswordResetController@reset');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\Home'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('about', 'HomeController@about');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/{slug}', 'CategoriesController@show');

    Route::get('posts', 'ArticlesController@index');
    Route::get('posts/{id}', 'ArticlesController@show');
    Route::get('{slug}', 'ArticlesController@show');
});

// Route::group(['prefix' => 'v1/admin', 'namespace' => 'Api\Admin'], function () {
Route::group(['prefix' => 'v1/admin', 'namespace' => 'Api\Admin', 'middleware' => 'jwt.admin'], function () {

    Route::get('posts/all', 'ArticlesController@all');
    // Route::delete('posts/forceDelete/{id}', 'ArticlesController@forceDelete');

    Route::resource('posts', 'ArticlesController');
    Route::resource('categories', 'CategoriesController');

    Route::get('users', 'UsersController@all');

    // Route::get('settings/index', 'SettingsController@index');
    // Route::patch('settings/index', 'SettingsController@update');

    Route::post('uploadImage', 'UsersController@uploadImage');
    Route::post('uploadAvatar', 'UsersController@uploadAvatar');
});