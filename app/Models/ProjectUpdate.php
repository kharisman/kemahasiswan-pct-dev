<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;
    public function internshipProjectUpdate(){
        return $this->belongsTo(Internship::class,'id', 'internship_id');
    }
    
    public function projectUpdate(){
        return $this->belongsTo(Project::class, 'id','project_id');
    }
   
        public function internship()
{
    return $this->belongsTo(Internship::class, 'internship_id');
}

public function project()
{
    return $this->belongsTo(Project::class, 'project_id');
}

    
}
