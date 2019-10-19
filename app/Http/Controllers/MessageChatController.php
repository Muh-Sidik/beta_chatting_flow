<?php

namespace App\Http\Controllers;

use App\DetailChat;
use App\User;
use App\Chat;
use App\Events\MessagePushed;
use Illuminate\Http\Request;

class MessageChatController extends Controller
{
    public function index($id)
    {
        
        $profil = User::find($id);
        $chat = \App\Chat::where('chats.id_user1', $id)
        ->select('*','users.username AS lawan', 'users.photo AS avatar')
        ->join('users','users.id', '=', 'chats.id_user2')->get();
        // $detail = \App\DetailChat::where('detail_chats.no_detail_chat', $id)->get();

        return response()->json($chat, 200);
    }

    public function getDetail($id)
    {
        
        $detail = \App\DetailChat::where('detail_chats.no_detail_chat', $id)
        ->join('users','users.id', '=', 'detail_chats.id_user_from')
        ->get();

        return response()->json([$detail], 200);
    }

    public function search($id)
    {
        // event(new MessagePushed($user, $message, $chat));
        $search = \App\DetailChat::where('detail_chats.chat', 'like', $_GET['search'])
        ->where('detail_chats.no_detail_chat', $id)
        ->join('users','users.id', '=', 'detail_chats.id_user_from')
        ->get();

        return response()->json([$search], 200);
    }

    public function sendchat(Request $request)
    {
        // event(new MessagePushed($user, $message, $chat));
        $from = $request->input('id_user1');
        $to = $request->input('id_user2');
        $chat = Chat::where('id_user1', $from)
        ->where('id_user2', $to)->count();
        
        if($chat <= 0) { //belum pernah chat maka jomblo :v
            $chat = Chat::count();
            $generate = $chat+1; 
            $generate = '00'. $generate;
            $insert = new Chat();
            $insert->no_detail_chat = $generate;
            $insert->id_user1 = $from;
            $insert->id_user2 = $to;
            $detailChat = new DetailChat();
            $detailChat->no_detail_chat = $generate;
            $detailChat->chat = $request->input('chat');
            $detailChat->id_user_from = $request->input('id_user_from');
            $detailChat->id_user_to = $request->input('id_user_to');
            if($insert->save() && $detailChat->save()) {
                return response()->json(['status' => 'Pesan terkirim!'], 200);
            }
        } else {
            $room = Chat::where('id_user1', $from)
            ->where('id_user2', $to)->first();
            // dd($room);
            $detailChat = new DetailChat();
            $detailChat->no_detail_chat = $room->no_detail_chat;
            $detailChat->chat = $request->input('chat');
            $detailChat->id_user_from = $request->input('id_user_from');
            $detailChat->id_user_to = $request->input('id_user_to');
            if($detailChat->save()) {
                return response()->json(['status' => 'Pesan terkirim mamank!'], 200);
            }
        }
    }

    


}
