<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";

    protected $fillable = [
        'salary_level', 'dob'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }

    public function bills() {
        return $this->hasMany('App\Bill');
    }
    
    public function books() {
        return $this->belongsToMany('App\Book')->withPivot('quantity')->withTimestamps();
    }

    public function position() {
        return $this->belongsToMany('App\Position');
    }


}
