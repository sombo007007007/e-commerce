<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    public $timestamps = false;

    protected $table ="roles";
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    // public function users() {
    //     return $this->belongsToMany(User::class, 'role_user','user_id','role_id');
    // }
}
