<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_user extends Model
{
    protected $table = "book_user";

    protected $fillable = [
        'comment', 'isLike', 'book_id', 'user_id', 'star', 'created_at', 'updated_at'
    ];
}
