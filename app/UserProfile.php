<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Model
{
    protected $fillable = [
        'gender', 'birthday', 'city',
    ];

    public function getUserData($id)
    {
        $foreignUserData = DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->select('users.id', 'users.name', 'users.lastName', 'users.email',
                'user_profiles.avatar', 'user_profiles.gender', 'user_profiles.birthday', 'user_profiles.city')
            ->where('user_id', $id)
            ->first();

        return $foreignUserData;
    }

    public function updateInfo($id, $info)
    {
        DB::table('user_profiles')
            ->where('user_id', $id)
            ->update(['city' => $info->get('city'),
                'gender' => $info->get('gender'),
                'birthday' => $info->get('birthday'),
            ]);
    }

    public function updateAvatar($id, $filename)
    {
        DB::table('user_profiles')
            ->where('user_id', $id)
            ->update(['avatar' => $filename,
            ]);
    }

    public function getAllUsers($parameters, $id)
    {
        if($parameters->searchName != null) $searchName = 'name';
        else $searchName = 'id';

        if($parameters->searchLastName != null) $searchLastName = 'lastName';
        else $searchLastName = 'id';

        if($parameters->searchCity != null) $searchCity = 'city';
        else $searchCity = 'id';

        $allUsers = DB::table('user_profiles')
            ->join('users', 'users.id', '=', 'user_profiles.user_id')
            ->leftjoin($id.'_friends', $id.'_friends.friend_id', '=', 'user_profiles.user_id')
            ->select('users.id', 'users.name', 'users.lastName', 'user_profiles.avatar',
                'user_profiles.birthday', 'user_profiles.city', $id.'_friends.status')
            ->where([['id', '<>', $id],
                [$searchName, 'like', '%'.$parameters->searchName.'%'],
                [$searchLastName, 'like', '%'.$parameters->searchLastName.'%'],
                [$searchCity, 'like', '%'.$parameters->searchCity.'%']])
            ->paginate(10);

        return $allUsers;
    }
}
