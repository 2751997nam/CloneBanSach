<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";

    protected $fillable = [
        'id', 'bill_code', 'employee_code', 'created_at', 'updated_at'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

}
