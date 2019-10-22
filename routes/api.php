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
Route::post('/cek', 'UserChatController@get_where_phone');

//edit profil
Route::post('/update', 'UserChatController@update_profil');


// kirim pesan/chta
Route::post('/messages', 'MessageChatController@sendchat');

//untuk QR
Route::post('login/QR/{phone}/{password}', 'UserChatController@qr');

//delete chat
Route::get('/delete', 'MessageChatController@delete_chat');
