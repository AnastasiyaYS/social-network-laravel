<?php

namespace App\Http\Controllers;

use App\University;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
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
        $userProfile = DB::table('user_profiles')->where('user_id', Auth::id())->first();
        return view('users.index', array('userProfile' => $userProfile, 'user' => Auth::user()));
    }

    public function edit()
    {
        $userProfile =  DB::table('user_profiles')->where('user_id', Auth::id())->first();
        return view('users.edit', array('userProfile' => $userProfile, 'user' => Auth::user()));
    }

    public function update(Request $request)
    {
        DB::table('user_profiles')
            ->where('user_id', Auth::id())
            ->update(['city' => $request->get('city'),

            ]);
        /*$userProfile = new UserProfile;

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $userProfile->avatar = $filename;
            $userProfile->save();
        }

        if($request->all()) {
            $userProfile->user_id = auth()->user()->id;
            $userProfile->fill($request->all());
            $userProfile->save();
        }

        foreach ($request->get('university') as $u)
        {
            $userUniversity = new University();
            $userUniversity->university_name = $u;
            $userUniversity->save();
        }   */

        //dd($request->all());

        return redirect()->route('users.index');
    }
}
