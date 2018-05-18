<?php

namespace App;

use App\Notifications\PasswordResetEmailNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'remember_token', 'is_customer', 'verifyToken', 'status', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verifyToken'
    ];

    public function employee() {
        return $this->hasOne('App\Employee', 'id', 'id');
    }

    public function books() {
        return $this->belongsToMany('App\Book')->withPivot('star', 'comment', 'isLike')->withTimestamps();
    }

    public function bookCarts() {
        return $this->belongsToMany('App\Book', 'cart')->withPivot('id', 'cart_code', 'quantity')->withTimestamps();
    }

    public function information() {
        return $this->hasOne(User_information::class);
    }

    public function verified() {
        return $this->status > 0;
    }

    public function disabled() {
        return $this->status == 2;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetEmailNotification($token));
    }
}
