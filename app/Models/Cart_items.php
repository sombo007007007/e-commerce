<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_items extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'cart_id', 'product_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'cart_id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
