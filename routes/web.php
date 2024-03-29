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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     *  Routes Admin
     */
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
        Route::get('/admin/user', 'AdminController@manageUsers')->name('admin.users');
        Route::get('/admin/category', 'AdminController@manageCategories')->name('admin.categories');
        Route::get('/admin/statistics', 'AdminController@viewStatistics')->name('admin.statistics');
        Route::get('/admin/edit', 'AdminController@edit')->name('admin.edit');
        Route::put('/admin/update', 'AdminController@update')->name('admin.update');
        Route::get('/admin/info', 'AdminController@info')->name('admin.info');
        Route::get('/admin/users/edit/{id}', 'AdminController@editUser')->name('admin.users_edit');

    });

    /**
     * Home Routes
     */
    Route::get('/user', 'HomeController@index')->name('home.index');
    Route::get('/', 'HomeController@post')->name('home.post');

    /**
     *  review articles
     */
    Route::get('/posts/detail/{id}', 'PostController@show')->name('posts.show');
    Route::get('/posts/review/{id}', 'PostController@review')->name('posts.review');
    Route::get('/posts/search', 'PostController@search')->name('posts.search');


    Route::fallback(function () {
        return view('errors.404');
    });

    Route::get('/category/{category}', 'PostController@getPostsByCategory')->name('posts.byCategory');
    Route::get('/category_admin/{category}', 'PostController@getPostsByCategoryAdmin')->name('posts.byCategoryAdmin');

    Route::group(['middleware' => ['guest']], function () {

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
        Route::post('captcha-validation', [CaptchaController::class, 'capthcaFormValidate']);
        Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha']);
    });

    Route::group(['middleware' => ['auth']], function () {

        Route::post('/upload', 'PostController@upload')->name('ckeditor.upload');
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/posts', 'PostController@index')->name('posts.list');

        /**
         * Create Post Routes
         */
        Route::get('/posts/create', 'PostController@create')->name('posts.create');
        Route::post('/posts', 'PostController@store')->name('posts.stored');

        /**
         * Edit Post Routes
         */
        Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
        Route::put('/posts/{id}', 'PostController@update')->name('posts.update');

        /**
         * Delete Post Routes
         */
        Route::delete('/posts/{id}', 'PostController@delete')->name('posts.delete');

        /**
         * Edit Profile Routes
         */
        Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

        /**
         * profile information
         */
        Route::get('/profile/info', 'ProfileController@info')->name('profile.info');

        /**
         * Comment Router
         */
        Route::post('/comments', 'CommentController@store')->name('comments.store');

        /**
         * Change Password
         */
        Route::get('/change-password', 'ChangePasswordController@index')->name('profile.changePassword');
        Route::post('/change-password', 'ChangePasswordController@store')->name('change.password');
    });
});
