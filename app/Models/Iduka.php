<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iduka extends Model
{
    use HasFactory;
    public function idukaUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
