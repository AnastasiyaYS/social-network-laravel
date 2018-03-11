<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class University extends Model
{
    public function exist($received_university)
    {
        if (empty(DB::table('universities')
            ->select('university_id')
            ->where('university_name', '=', $received_university)
            ->first())){
            return false;
        }
        else return true;
    }

    public function saveUniversityRelations($user_id, $received_university)
    {
        $university = DB::table('universities')
            ->select('university_id')
            ->where('university_name', '=', $received_university)
            ->first();

        if (!$this->existenceUniversity($user_id, $university))
            DB::table('university_relations')->insert(
                ['user_id' => $user_id, 'university_id' => $university->university_id]);
    }

    public function existenceUniversity($user_id, $university)
    {
        $university = DB::table('university_relations')
            ->select('university_id')
            ->where([['user_id', '=', $user_id], ['university_id', '=', $university->university_id]])
            ->first();

        if ($university != null) return true;
            else return false;
    }

    public function getUserUniversities($user_id)
    {
        $userUniversities = DB::table('university_relations')
            ->join('universities', 'university_relations.university_id', '=', 'universities.university_id')
            ->select('universities.university_id', 'universities.university_name')
            ->where('university_relations.user_id', '=', $user_id)
            ->get();
        return $userUniversities;
    }

    public function getAllUniversities()
    {
        $universities = DB::table('universities')
            ->select('university_name')
            ->get();
        return $universities;
    }

    public function deleteUserUniversity($user_id, $university_id)
    {
        DB::table('university_relations')
            ->where([['user_id', '=', $user_id], ['university_id', '=', $university_id]])
            ->delete();
    }

}
