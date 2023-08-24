<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;
    public function internshipUser(){
        return $this->hasOne(User::class,'id','internship_id');
    }
}

