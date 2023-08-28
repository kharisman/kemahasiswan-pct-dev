<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipsApply extends Model
{
    use HasFactory;
    public function internshipApply(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
    public function idukaApply(){
        return $this->hasOne(Iduka::class,'id','iduka_id');
    }
}
