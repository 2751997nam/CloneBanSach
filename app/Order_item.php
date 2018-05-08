<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $table = "order_items";

    protected $fillable = [
        'id', 'book_code', 'name', 'price', 'quantity', 'discount', 'created_at', 'updated_at', 'order_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
