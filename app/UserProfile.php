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
        $userData = DB::table('user_profiles')->where('user_id', $id)->first();
        return $userData;
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

}
