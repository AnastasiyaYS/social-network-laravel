<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\University;
use App\Friend;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userData = new UserProfile();
        $possibleFriend = new Friend();
        return view('search.index', array('userProfile' => $userData->getUserData(Auth::id()),
            'allUsers' => $userData->getAllUsers($request, Auth::id()), 'search' => $request,
            'possibleFriends' => $possibleFriend->getPossibleFriends(Auth::id())));
    }

    public function show($id)
    {
        $userData = new UserProfile();
        $userUniversities = new University();
        return view('search.show_user', array('userProfile' => $userData->getUserData(Auth::id()),
            'foreignUserProfile' => $userData->getUserData($id),
            'userUniversities' => $userUniversities->getUserUniversities($id),
            'userStatus' => $userData->getStatus($id, Auth::id())));
    }
}
