<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ["name", "slug"];
    public $timestamps = false;

    
    public function users(){
        return $this->belongsToMany("App\User");
        // return $this->belongsToMany("App\User", "categories_users", "user_id", "category_id");
    }
    
    public function concerts(){
        return $this->belongsToMany("App\Concert");
        // return $this->belongsToMany("App\User", "categories_users", "user_id", "category_id");
    }
}
