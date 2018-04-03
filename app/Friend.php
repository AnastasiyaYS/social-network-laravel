<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friend extends Model
{
    public function getFriends($parameters, $id)
    {
        if($parameters->searchName != null) $searchName = 'name';
        else $searchName = 'id';

        if($parameters->searchLastName != null) $searchLastName = 'lastName';
        else $searchLastName = 'id';

        if($parameters->searchCity != null) $searchCity = 'city';
        else $searchCity = 'id';

        $friends = DB::table($id.'_friends')
            ->join('users', 'users.id', '=', $id.'_friends.friend_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', $id.'_friends.friend_id')
            ->select('users.id', 'users.name', 'users.lastName', 'user_profiles.avatar',
                'user_profiles.birthday', 'user_profiles.city', $id.'_friends.status')
            ->where([['id', '<>', $id],
                ['status', 2],
                [$searchName, 'like', '%'.$parameters->searchName.'%'],
                [$searchLastName, 'like', '%'.$parameters->searchLastName.'%'],
                [$searchCity, 'like', '%'.$parameters->searchCity.'%']])
            ->paginate(10);

        return $friends;
    }

    public function addFriend($id_friend, $id)
    {
        DB::table($id.'_friends')
            ->insert(['friend_id' => $id_friend, 'status' => 0]);

        DB::table($id_friend.'_friends')
            ->insert(['friend_id' => $id, 'status' => 1]);
    }

    public function getRequestsFriends($id)
    {
        $requests = DB::table($id.'_friends')
            ->join('users', 'users.id', '=', $id.'_friends.friend_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', $id.'_friends.friend_id')
            ->select($id.'_friends.friend_id', $id.'_friends.status', 'user_profiles.avatar', 'users.name', 'users.lastName')
            ->where('status', 1)
            ->get();

        return $requests;
    }

    public function confirmFriend($id_friend, $id)
    {
        DB::table($id.'_friends')
            ->where('friend_id', $id_friend)
            ->update(['friend_id' => $id_friend, 'status' => 2]);

        DB::table($id_friend.'_friends')
            ->where('friend_id', $id)
            ->update(['friend_id' => $id, 'status' => 2]);
    }
}
