<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;
    
    public function internshipProjectUpdate(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
    public function projectUpdate(){
        return $this->hasOne(Project::class,'id','project_id');
    }
}
