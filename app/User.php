<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany("App\Order", "user_id", "id");
    }

    public function categories(){
        return $this->belongsToMany("App\Category", "categories_users", "user_id", "category_id");
    }

    public function concerts(){
        return $this->belongsToMany("App\Concert", "concerts_users", "user_id", "concert_id");
    }

    public function favorites(){
        return $this->belongsToMany("App\Concert", "users_favorites", "user_id", "concert_id");
    }

}
