<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_Users extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}