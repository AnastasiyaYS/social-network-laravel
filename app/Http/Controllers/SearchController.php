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
        return view('search.index', array('userProfile' => $userData->getUserData(Auth::id()),
            'allUsers' => $userData->getAllUsers($request, Auth::id()), 'search' => $request));
    }

    public function show($id)
    {
        $userData = new UserProfile();
        $userUniversities = new University();
        return view('search.show_user', array('userProfile' => $userData->getUserData(Auth::id()),
            'foreignUserProfile' => $userData->getUserData($id),
            'userUniversities' => $userUniversities->getUserUniversities($id)));
    }
}
