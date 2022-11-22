<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dv_users_role extends Model
{
    use HasFactory;
    public $timestamps = false; 

    public function users()
    {
        return $this->belongsToMany(DvUser::class);
    }
}
