<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rouleclinets;

class Accountclinets extends Model
{
    protected $table = 'account_clinet';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'city',
        'village',
        'commune',
        'district',
        'provinces',
        'postal_code',
        'password',
        'config_password',
    ];
    public function role_clinet(){
        return $this->belongsToMany(Rouleclinets::class, 'role_role_account_clinets','account_clinet_id','role_clinet_id');
    }
}

