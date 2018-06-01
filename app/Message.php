<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    public function getDialogs($id)
    {
        //Последние сообщения диалогов (в переменной собеседники и id последних сообщений с ними)
        $chat = DB::table($id.'_messages')
            ->select(DB::raw('max(message_id) as max, chat_id as id'))
            ->groupBy('chat_id')
            ->get();

        $friends = DB::table($id.'_messages')
            ->join('users', 'users.id', '=', $id.'_messages.chat_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', $id.'_messages.chat_id')
            ->select($id.'_messages.*', 'name', 'lastName', 'avatar')
            ->whereIn('message_id', $chat->pluck('max'))
            ->orderBy('message_id', 'desc')
            ->get();

        return $friends;
    }

    public function saveMessage($id_user, $id_friend, $message)
    {
        DB::table($id_user.'_messages')
            ->insert(['chat_id' => $id_friend, 'sender_id' => $id_user, 'text' => $message->message_text,
                    'file' => $message->message_file, 'status' => 0]);

        DB::table($id_friend.'_messages')
            ->insert(['chat_id' => $id_user, 'sender_id' => $id_user, 'text' => $message->message_text,
                'file' => $message->message_file, 'status' => 0]);
    }

    public function getMessages($id_user, $id_friend)
    {
        $messages = DB::table($id_user.'_messages')
            ->join('user_profiles', 'user_profiles.user_id', '=', $id_user.'_messages.sender_id')
            ->select($id_user.'_messages.*', 'user_profiles.avatar')
            ->where('chat_id', $id_friend)
            ->get();

        DB::table($id_user.'_messages')
            ->where('status', 0)
            ->where('chat_id', $id_friend)
            ->where('sender_id', $id_friend)
            ->update(['status' => 1]);

        DB::table($id_friend.'_messages')
            ->where('status', 0)
            ->where('chat_id', $id_user)
            ->where('sender_id', $id_friend)
            ->update(['status' => 1]);

        return $messages;
    }

    public function pen_pal($id)
    {
        return DB::table('users')
            ->select('name', 'lastName')
            ->where('id', $id)
            ->first();
    }
}
