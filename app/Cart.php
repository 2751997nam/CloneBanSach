<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = [
        'id', 'book_id', 'user_id', 'cart_code', 'quantity', 'was_paided'
    ];
}
