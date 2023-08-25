<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public function internshipDocument(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
}
