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
    public function projectApplies()
    {
        return $this->hasMany(ProjectApply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialMediaLinks()
    {
        return $this->hasMany(SocialMediaLink::class);
    }

}

