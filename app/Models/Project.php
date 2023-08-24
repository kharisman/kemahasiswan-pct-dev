<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function categoryProject(){
        return $this->hasOne(Project_Category::class,'id','category_id');
    }
    public function idukaProject(){
        return $this->hasOne(Iduka::class,'id','iduka_id');
    }
}
