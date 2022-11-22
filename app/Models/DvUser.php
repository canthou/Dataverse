<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvUser extends Model
{
    use HasFactory;
    public $timestamps = false; 

    public function roles()
    {
        return $this->belongsToMany(Dv_users_role::class, 'dv_users_roles_has_dv_users', 'dv_users_id', 'dv_users_roles_id');
    }
}
