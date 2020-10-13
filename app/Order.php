<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ["concert_id", "user_id", "created_at", "updated_at"];

    public function concert(){
        return $this->hasOne("App\Concert", "id", "concert_id");
    }

    public function user(){
        return $this->hasOne("App\User", "id", "user_id");
    }
}
