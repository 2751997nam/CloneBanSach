<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";

    protected $fillable = [
        'position_code', 'name', 'base_salary_level'
    ];

    public function employees() {
        return $this->hasMany('App\Employee');
    }
}
