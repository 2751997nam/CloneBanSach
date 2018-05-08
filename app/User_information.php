<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_information extends Model
{
    protected $table = "user_information";

    protected $fillable = [
        'id', 'phone', 'gender', 'dob', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
