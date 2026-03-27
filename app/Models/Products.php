<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Products extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'image',
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'created_at',
        'updated_at'
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class , 'category_id');
    }
}