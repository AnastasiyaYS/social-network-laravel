<?php

namespace App\Http\Controllers;

use App\University;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userData = new UserProfile();
        $userUniversities = new University();
        return view('profile.index', array('userUniversities' => $userUniversities->getUserUniversities(Auth::id()),
            'userProfile' => $userData->getUserData(Auth::id()), 'user' => Auth::user()));
    }

    public function edit()
    {
        $userData = new UserProfile();
        $userUniversities = new University();
        return view('profile.edit', array('universities' => $userUniversities->getAllUniversities(),
            'userUniversities' => $userUniversities->getUserUniversities(Auth::id()),
            'userProfile' => $userData->getUserData(Auth::id()), 'user' => Auth::user()));
    }

    public function update(Request $request)
    {
        $userProfile = new UserProfile();
        $userProfile->updateInfo(Auth::id(), $request);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $userProfile->updateAvatar(Auth::id(), $filename);
        }

        if($request->get('university'))
            foreach ($request->get('university') as $received_university)
            {
                if ($received_university != null)
                {
                    $university = new University();

                    if (!$university->exist($received_university))
                    {
                        $university->university_name = $received_university;
                        $university->save();

                    }
                    $university->saveUniversityRelations(Auth::id(), $received_university);
                }
            }
        return redirect()->route('profile.index');
    }

    public function universityDestroy($id){
        $university = new University();
        $university->deleteUserUniversity(Auth::id(), $id);
        return redirect()->route('profile.edit');
    }
}
