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

Auth::routes();

Route::group(['prefix'=>'setting'], function(){
    Route::post('/change_password','SettingController@change_password');
    Route::post('/change_info_user','SettingController@change_info_user');
});

Route::group(['prefix'=>'profile'], function(){
    Route::post('/','ProfileController@user_loggin');
    Route::post('/change_avatar','ProfileController@change_avatar');
    Route::post('/change_cover_image','ProfileController@change_cover_image');
});

Route::group(['prefix'=>'home'], function(){
    Route::post('/posts_with_friend','HomeController@posts_with_friend');   
});

Route::group(['prefix'=>'group'], function(){
    Route::post('/all_group_of_user', 'GroupController@all_group_of_user');
    Route::post('/info_group','GroupController@info_group');
    Route::post('/create','GroupController@create');
    Route::post('/user_of_group','GroupController@user_of_group');
    Route::post('/out_group','GroupController@out_group');
    Route::post('/delete_group','GroupController@delete_group');
    Route::post('/edit_name','GroupController@edit_name');
    Route::post('/check_user_of_group', 'GroupController@check_user_of_group');
});

Route::group(['prefix'=>'message'], function(){
    Route::post('/group/{id}', 'GroupMessageController@messages');
    Route::post('/send_group_message', 'GroupMessageController@send_group_message');

    Route::post('/user/{id}','FriendMessageController@messages');
    Route::post('/send_user_message','FriendMessageController@send_user_message');
});

Route::group(['prefix'=>'user_of_group'], function(){
    Route::post('/add', 'UserOfGroupController@add');
});

Route::group(['prefix'=>'post'], function(){
    Route::post('/edit_post','PostController@edit_post');
    Route::post('/delete_img_in_post','PostController@delete_img_in_post');
    
    Route::post('detail_post','PostController@detail_post');
    Route::post('/edit_post','PostController@edit_post');
    Route::post('/likes','PostController@likes');
    Route::post('user_likes','PostController@user_likes');
    Route::post('/my_post','PostController@my_post');
    Route::post('/delete_post','PostController@delete_post');
    Route::post('/create_post','PostController@create_post');
    Route::post('top_comments','PostController@top_comments');
    Route::post('/like_the_article','PostController@like_the_article');
    Route::post('/delete_post_with_id','PostController@delete_post_with_id');
    Route::post('/comments_post_parent','PostController@comments_post_parent');
    Route::post('/comment_to_post_parent','PostController@comment_to_post_parent');
    Route::post('delete_comment_post_parent','PostController@delete_comment_post_parent');
    
});

Route::group(['prefix'=>'friend'], function(){
    Route::post('/find_user','FriendController@find_user');
    Route::post('/add_friend','FriendController@add_friend');
    Route::post('/list_invitation','FriendController@list_invitation');
    Route::post('/agree','FriendController@agree');
    Route::post('/destroy','FriendController@destroy');
    Route::post('/list_friend','FriendController@list_friend');
    Route::post('/delete_friend','FriendController@delete_friend');
    Route::post('/list_friend_not_of_from','FriendController@list_friend_not_of_from');
    Route::post('/info_friend','FriendController@info_friend');
    Route::post('/check_friend','FriendController@check_friend');
});

Route::group(['prefix'=>'tracking'], function(){
    Route::post('/all_tracking','TrackingUserController@all_tracking');
    Route::post('/add_tracking','TrackingUserController@add_tracking');
    Route::post('/find_user','TrackingUserController@find_user');
});

Route::get('/{any}', function(){
    return view('index');
})->where('any', '.*')->middleware('auth'); 

