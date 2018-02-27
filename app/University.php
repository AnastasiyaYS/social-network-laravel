<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'university_id', 'university_name', 'user_id',
    ];
}
