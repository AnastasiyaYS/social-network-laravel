<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('users.index', array('user' => Auth::user()));

    }

    public function edit()
    {
        return view('users.edit', array('user' => Auth::user()));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user->avatar = $filename;
            $user->save();
        }

        if($request->all()) {
            $user->fill($request->all());
            //$user->save();
        }

        dd($request->all());

        return redirect()->route('users.update');
    }
}
