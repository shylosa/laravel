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

Route::get('/project/{slug}', 'HomeController@show')->name('project.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');

Route::group(['middleware'=>'auth'], static function(){
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/logout', 'AuthController@logout');
});

Route::group(['middleware'=>'guest'], static function(){
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
    Route::get('/login','AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware'=>'admin'], static function(){
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/projects', 'ProjectsController');
    Route::resource('/tests', 'TestsController');
});

Route::get('/about/{id}', function($id){
    return "About: " . $id;
});

//Route::get('/', 'HomeController@index');
Route::get('/', static function (){
    dump('Hello world!');
    return view('welcome');
});
