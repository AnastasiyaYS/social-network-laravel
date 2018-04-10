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

        DB::table('friends')
            ->insert([
                ['user_id_1' => $id, 'user_id_2' => $id_friend],
                ['user_id_1' => $id_friend, 'user_id_2' => $id]
                ]);
    }

    public function getPossibleFriends($id_user)
    {
        $friends = DB::table('friends')
            ->join('users', 'users.id', '=', 'friends.user_id_2')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'friends.user_id_2')
            ->where('user_id_2', '<>', $id_user)
            ->whereIn('user_id_1', function ($query) use ($id_user) {
                return $query->select(DB::raw('friend_id'))
                    ->from($id_user.'_friends')
                    ->whereRaw('status', 2)
                    ->get();
            })
            ->whereNotIn('user_id_2', function ($query) use ($id_user) {
                return $query->select(DB::raw('friend_id'))
                    ->from($id_user.'_friends')
                    ->get();
            })
            ->select('user_id_2', DB::raw('count(*) as common_friends'), 'users.name', 'users.lastName', 'user_profiles.avatar')
            ->groupby('user_id_2', 'avatar')
            ->orderby('common_friends', 'desc')
            ->limit(3)
            ->inRandomOrder()
            ->get();

        return $friends;
    }
}
