<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\Friend;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userData = new UserProfile();
        $friends = new Friend();
        return view('friends.index', array('userProfile' => $userData->getUserData(Auth::id()),
            'friends' => $friends->getFriends($request, Auth::id()), 'search' => $request,
            'requests' => $friends->getRequestsFriends(Auth::id())));
    }

    public function add_friend($id)
    {
        $friend = new Friend();
        $friend->addFriend($id, Auth::id());

        return redirect()->route('search');
    }

    public function confirm_friend($id)
    {
        $friend = new Friend;
        $friend->confirmFriend($id, Auth::id());

        return redirect()->route('friends');
    }
}

