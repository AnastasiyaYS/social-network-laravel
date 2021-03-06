<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new profile as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect profile after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/profile';
    protected function redirectTo()
    {
        DB::table('user_profiles')->insert(
            ['avatar' => 'default.png', 'user_id' => Auth::id()]
        );

        Schema::create(Auth::id().'_friends', function (Blueprint $table) {
            $table->integer('friend_id')->unsigned();
            $table->integer('status')->unsigned();

            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create(Auth::id().'_messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->integer('chat_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->text('text');
            $table->string('file')->nullable();
            $table->string('orig_file_name')->nullable();
            $table->integer('status')->unsigned();
            $table->timestamps();
        });

        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
