<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/posts/{id}/detail', 'PostController@show')->name('posts.show');
    Route::get('/posts/search', 'PostController@search')->name('posts.search');
    Route::fallback(function () {
        return view('errors.404');
    });
    Route::get('/posts/{category}/category', 'PostController@getPostsByCategory')->name('posts.byCategory');



    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/posts', 'PostController@index')->name('posts.list');
        Route::get('/posts/create', 'PostController@create')->name('posts.create');
        Route::post('/posts', 'PostController@store')->name('posts.stored');
        Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
        Route::put('/posts/{id}', 'PostController@update')->name('posts.update');
        Route::delete('/posts/{id}', 'PostController@delete')->name('posts.delete');

        Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

    });
});
