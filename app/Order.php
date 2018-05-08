<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'id', 'user_id', 'name', 'phone', 'email', 'address', 'created_at', 'updated_at'
    ];

    public function bill() {
        return $this->hasOne(Bill::class);
    }

    public function order_items() {
        return $this->hasMany(Order_item::class);
    }
}
