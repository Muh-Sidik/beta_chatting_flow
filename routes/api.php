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

//register
Route::post('/register', 'UserChatController@register');

//login
Route::post('/login', 'UserChatController@login');

//get phone
Route::post('/cek', 'UserChatController@get_where_phone');

//edit profil
Route::post('/update', 'UserChatController@update');

// kirim pesan/chat
Route::post('/messages', 'MessageChatController@sendchat');
//edit chat
// Route::put('/messages/edit', 'MessageChatController@edit_chat');
//hapus chat
Route::delete('/messages/delete/{id}', 'MessageChatController@delete_chat');
//get detailchat
Route::get('/chat/{no_detail_chat}', 'MessageChatController@getDetail');

//untuk QR
Route::post('login/QR/{phone}/{password}', 'UserChatController@qr');

//hapus user
Route::delete('/delete/user/{id}', 'MessageChatController@delete_user');
