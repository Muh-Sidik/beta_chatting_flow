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

Route::post('/register', 'UserChatController@register');
Route::post('/login', 'UserChatController@login');

Route::get('/user/{id}', 'MessageChatController@index');
Route::get('/chat/{id}', 'MessageChatController@getDetail');
Route::get('/search/{no_detail_chat}', 'MessageChatController@search');

Route::post('/messages', 'MessageChatController@sendchat');
