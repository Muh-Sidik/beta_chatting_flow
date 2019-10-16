<?php

namespace App\Http\Controllers;

use App\DetailChat;
use App\User;
use App\Chat;
use Illuminate\Http\Request;

class MessageChatController extends Controller
{
    public function index($id)
    {
        $profil = User::find($id);
        $chat = \App\Chat::where('chats.id_user_from', $id)->get();
        // $detail = \App\DetailChat::where('detail_chats.no_detail_chat', $id)->get();

        return response()->json([$profil, $chat], 200);
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
        $search = \App\DetailChat::where('detail_chats.chat', 'like', $_GET['search'])
        ->where('detail_chats.no_detail_chat', $id)
        ->join('users','users.id', '=', 'detail_chats.id_user_from')
        ->get();

        return response()->json([$search], 200);
    }

    public function sendchat(Request $request)
    {
        $from = $request->input('id_user_from');
        $to = $request->input('id_user_to');
        $chat = Chat::where('id_user_from', $from)
        ->where('id_user_to', $to)->count();
        
        if($chat <= 0) { //belum pernah chat maka jomblo :v
            $chat = Chat::count();
            $generate = $chat+1; 
            $generate = '00'. $generate;
            $insert = new Chat();
            $insert->no_detail_chat = $generate;
            $insert->id_user_from = $from;
            $insert->id_user_to = $to;
            $detailChat = new DetailChat();
            $detailChat->no_detail_chat = $generate;
            $detailChat->chat = $request->input('chat');
            $detailChat->id_user_from = $from;
            $detailChat->id_user_to = $to;
            if($insert->save() && $detailChat->save()) {
                return response()->json(['status' => 'Pesan terkirim!'], 200);
            }
        } else {
            $detailChat = new DetailChat();
            $insert->no_detail_chat = $request->input('no_detail_chat');
            $insert->chat = $request->input('chat');
            $insert->id_user_from = $from;
            $insert->id_user_to = $to;
            if($insert->save()) {
                return response()->json(['status' => 'Pesan terkirim mamank!'], 200);
            }
        }
    }

    


}
