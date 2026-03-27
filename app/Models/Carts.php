<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Carts extends Model
{
    public $timestamps = false;
    protected $fillable = ['id','user_id','created_at','updated_at'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart_items(){
        return $this->hasMany(CartItems::class, 'cart_id');
    }
}
