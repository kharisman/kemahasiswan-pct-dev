<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Apply extends Model
{
    use HasFactory;
    public function internshipProjectApply(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
    public function projectApply(){
        return $this->hasOne(Project::class,'id','project_id');
    }
}
