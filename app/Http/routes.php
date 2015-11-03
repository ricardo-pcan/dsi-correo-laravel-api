<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::resource('user', 'UserController');

Route::get( 'dsi_users', [
    'uses' => 'UserController@get_dsi_users',
    'as' => 'get_dsi_users'
]);

Route::get( 'admins', [
    'uses' => 'UserController@get_admins',
    'as' => 'get_admins'
]);

Route::resource('request', 'RequestController');
Route::resource('user.request', 'UserRequestController');
//Route::resource('user.comment', 'UserCommentController');
//Route::resource('request.user', 'RequestUserController');
