<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dv_users_roles_has_dv_user extends Model
{
    public $timestamps = false; 
    use HasFactory;
    protected $table='dv_users_roles_has_dv_users';
}
