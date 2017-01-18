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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::resource('dashboard', 'Admin\AdminController');

    Route::resource('roles', 'Role\RoleController');
    Route::get('/role/list', 'User\UserController@listUserByRole')->name('list-role');
    Route::post('/set-role', 'User\UserController@setRole')->name('set-role');

    Route::resource('permissions', 'Permission\PermissionController');
    Route::get('/permission/list', 'Permission\PermissionController@listPermissionByRole')->name('list-permistion');
    Route::post('/set-permission', 'Permission\PermissionController@setPermission')->name('set-permission');
    Route::resource('categories', 'Category\CategoryController');
    Route::get('posts', 'Post\PostController@indexAdmin')->name('list-posts');
    Route::post('/status', 'Post\PostController@publish')->name('publish-posts');
    Route::post('/comment-status', 'Comment\CommentController@publish')->name('publish-comments');
    Route::resource('tags', 'Tag\TagController');
});

Route::get('/redirect/{provider}','User\UserController@redirect');

Route::get('/callback/{provider}','User\UserController@callback');

Route::resource('posts', 'Post\PostController');

Route::resource('comments', 'Comment\CommentController');

Route::get('post/like/{id}', ['as' => 'post.like', 'uses' => 'Like\LikeController@likePost']);

Route::get('comment/like/{id}', ['as' => 'comment.like', 'uses' => 'Like\LikeController@likeComment']);


