<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userData = new UserProfile();
        $dialogs = new Message();
        return view('messages.index', array('userProfile' => $userData->getUserData(Auth::id()),
            'dialogs' => $dialogs->getDialogs(Auth::id())));
    }

    public function dialog($id, Request $request)
    {
        $userData = new UserProfile();

        $message = new Message();
        if($request->input('message_text') || $request->input('message_file')) $message->saveMessage(Auth::id(), $id, $request);

        return view('messages.dialog', array('userProfile' => $userData->getUserData(Auth::id()),
            'messages' => $message->getMessages(Auth::id(), $id), 'chat_id' => $id,
            'pen_pal' => $message->pen_pal($id) ));
    }
}
