<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApply extends Model
{
    use HasFactory;
    public function internshipProjectApply(){
        return $this->hasOne(Internship::class,'id','internship_id');
    }
    public function projectApply(){
        return $this->hasOne(Project::class,'id','project_id');
    }
    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
    public function project()
{
    return $this->belongsTo(Project::class);
}

}
