<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function category(){
        return $this->hasOne(ProjectCategory::class,'id','category_id');
    }
    public function idukaProject()
    {
        return $this->hasOne(Iduka::class, 'id', 'iduka_id');
    }

    protected $fillable = ['iduka_id', 'name', 'category_id','notes', 'updated_at', 'created_at'];
    
    public function categories()
    {
        return $this->belongsToMany(Project_Category::class, 'projectcategory');
    }
}
