<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $table = "concerts";
    protected $fillable = ["name", "slug", "date", "place", "price", "ticket_total", "ticket_left", "created_at", "updated_at"];

    public function orders(){
        return $this->hasMany("App\Order", "concert_id", "id");
    }
    
    public function categories(){
        return $this->belongsToMany("App\Category", "concerts_categories", "concert_id", "category_id");
    }
    
    public function artists(){
        return $this->belongsToMany("App\User", "concerts_users", "concert_id", "user_id");
    }

}
