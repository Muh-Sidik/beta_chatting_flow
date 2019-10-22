<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'UserChatController@register');
Route::post('/login', 'UserChatController@login');

// Route::get('/user/{id}', 'MessageChatController@index');
// Route::get('/user/{id}', 'MessageChatController@getDetail');

Route::get('/user/id/{id}', 'UserChatController@getUserById');
Route::get('/user/phone/{phone}', 'UserChatController@getUserByPhone');
Route::post('/update', 'UserChatController@update');


Route::post('/chat', 'MessageChatController@chat');
Route::post('/write', 'MessageChatController@write');

Route::post('/messages', 'MessageChatController@sendchat');
Route::post('/detailchat', 'MessageChatController@getDetail');
Route::post('/searchchat', 'MessageChatController@search');
