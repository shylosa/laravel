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
    Route::get('/projects/{slug}', 'HomeController@show')->name('pages.show');
    Route::get('/tags/{slug}', 'HomeController@tag')->name('tags.show');
    Route::get('/categories/{slug}', 'HomeController@category')->name('categories.show');
    Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');

    Route::group(['middleware' => 'auth'], static function () {
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
        Route::get('/logout', 'AuthController@logout')->name('logout');
    });

    Route::group(['middleware' => 'guest'], static function () {
        Route::get('/register', 'AuthController@registerForm')->name('register');
        Route::post('/register', 'AuthController@register');
        Route::get('/login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@login');
    });
});

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
