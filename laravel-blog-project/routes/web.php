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

Route::get('/', 'HomeController@welcome');

Route::resource('/posts', 'PostsController');

Route::prefix('/home')->group(function () {
    Route::get('/', 'HomeController@personal');
    Route::post('/updateinfo', 'HomeController@updateinfo');
    Route::post('/updateavatar', 'HomeController@updateavatar');
    
    
    Route::get('/posts', 'HomeController@posts');
    Route::get('/forum', 'HomeController@forum');
});

Route::resource('/forums', 'ForumsController');
Route::resource('/comments', 'CommentsController');

Auth::routes();


