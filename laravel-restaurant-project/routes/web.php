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

Route::prefix('/')->group(function () {
    Route::get('/', 'WelcomesController@index');
    Route::resource('/bookroom', 'BookRoomsController');
    Route::get('/feedback', 'FeedbacksController@feedback');

    Route::get('/mon-an', 'FoodsController@all');
    Route::resource('/danh-muc', 'CategoriesController');
    Route::resource('/danh-muc/mon-an', 'FoodsController');
});

Route::prefix('/home')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::post('/updateavatar', 'HomeController@updateavatar');

    Route::resource('/danh-muc', 'CategoriesController');
    Route::any('/danh-muc/tim-kiem','CategoriesController@search');

    Route::resource('/mon-an', 'FoodsController');
    Route::any('/mon-an/tim-kiem','FoodsController@search');

    Route::resource('/phong', 'RoomsController');
    Route::any('/phong/tim-kiem','RoomsController@search');

    Route::resource('/hinh-anh', 'ImagesController');

    Route::get('/phan-hoi-tu-khach-hang', 'FeedbacksController@show');
    Route::get('/phan-hoi-tu-khach-hang/destroy', 'FeedbacksController@destroy');

    Route::resource('/danh-sach-dat-phong', 'BookRoomsController');
    Route::any('/danh-sach-dat-phong/tim-kiem','BookRoomsController@search');
    
    Route::get('/danh-sach-phong-da-dat', 'BookRoomsController@index2');
    Route::any('/danh-sach-phong-da-dat/tim-kiem','BookRoomsController@searched');
});

Route::get('/register', function(){
    return redirect()->back();
});

Auth::routes();


