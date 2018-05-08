<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";

    protected $fillable = [
        'id','book_code', 'name', 'img', 'price', 'author', 'quantity', 'publisher', 'description'
    ];

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function users() {
        return $this->belongsToMany('App\user')->withPivot('star', 'comment', 'isLike')->withTimestamps();
    }

    public function cartUsers() {
        return $this->belongsToMany('App\User', 'cart')->withPivot('id', 'cart_code', 'quantity')->withTimestamps();
    }

}
