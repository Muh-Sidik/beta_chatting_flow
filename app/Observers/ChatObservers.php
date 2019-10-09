<?php
namespace App\Observers;

use App\DetailChat;
use App\Notifications\NewNotif;
use App\User;

class ChatObserver
{
    public function created(DetailChat $chat)
    {
        // $author = $chat->user;
        // $users = User::all();
        // foreach ($users as $user) {
        //     $user->notify(new NewNotif($chat, $author));
        // }
    }
}