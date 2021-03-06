<?php

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

use App\Services\Localization\LocalizationService;

Auth::routes();

Route::group(['middleware' => 'language', 'prefix' => LocalizationService::locale()], static function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/projects/{slug}', 'HomeController@show')->name('projects.show_project');
    Route::get('/tags/{slug}', 'HomeController@tags')->name('tags.show_tag');
    Route::get('/categories/{slug}', 'HomeController@categories')->name('categories.show_category');

    Route::group(['middleware' => 'auth'], static function () {
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
        Route::get('/logout', 'AuthController@logout')->name('logout');
    });

    Route::group(['middleware' => 'guest'], static function () {
        Route::get('/register', 'AuthController@registerForm')->name('register');
        Route::post('/register', 'AuthController@register')->name('register.store');
        Route::get('/login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@login');
    });
});

Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], static function () {
    Route::get('/', 'DashboardController@index')->name('admin');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/users', 'UserController');
    Route::resource('/projects', 'ProjectController');
    Route::resource('/tests', 'TestController');
    Route::get('/photos-upload', 'PhotoController@photosUpload')->name('photos.upload');
});

Route::get('/about/{id}', static function ($id) {
    return 'About: ' . $id;
});
