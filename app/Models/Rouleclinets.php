<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accountclinets;

class Rouleclinets extends Model
{
    protected $table ="role_clinet";
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
    public function account_clinets() {
        return $this->belongsToMany(AccountClinet::class, 'role_role_account_clinets','role_clinet_id','account_clinet_id');
    }
}
