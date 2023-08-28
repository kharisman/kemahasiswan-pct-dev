<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLink extends Model
{
    use HasFactory;

    public function internshipAccount(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
}
