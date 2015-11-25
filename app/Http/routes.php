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
Route::resource('users', 'UserController');

Route::get( 'dsi_users', [
    'uses' => 'UserController@get_dsi_users',
   'as' => 'get_dsi_users'
]);

Route::get( 'admins', [
    'uses' => 'UserController@get_admins',
    'as' => 'get_admins'
]);

Route::resource('requests', 'RequestController',
    [ 'only' => [ 'index' ] ] );

Route::resource('users.requests', 'UserRequestController',
    [ 'except' => [ 'create' ] ] );

Route::resource( 'requests.users', 'RequestUserController',
    [ 'only' => [ 'index', 'destroy' ] ] );

Route::resource('users.comments', 'UserCommentController');
//Route::resource('request.user', 'RequestUserController');
