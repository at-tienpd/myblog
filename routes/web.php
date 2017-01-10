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
    Route::resource('roles', 'Role\RoleController');
    Route::get('/role/list', 'User\UserController@listUserByRole')->name('list-role');;
    Route::post('/set-role', 'User\UserController@setRole')->name('set-role');
    Route::get('/', function () {
        return view('template.admin');
    });
});
