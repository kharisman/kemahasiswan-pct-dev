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
    protected $fillable = ['id','user_id','name', 'address', 'phone', 'photo', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
