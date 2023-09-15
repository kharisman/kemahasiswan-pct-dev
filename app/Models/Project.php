<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;
   
    public function idukaProject()
    {
        return $this->hasOne(Iduka::class, 'id', 'iduka_id');
    }

    protected $fillable = ['iduka_id', 'name', 'category_id','notes', 'updated_at', 'created_at'];
    
    // public function categories()
    // {
    //     return $this->belongsToMany(Project_Category::class, 'projectcategory');
    // }
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class);
    }

    public function iduka()
    {
        return $this->belongsTo(Iduka::class, 'iduka_id', 'id');
    }

    public function projectApplies()
    {
        return $this->hasMany(ProjectApply::class);
    }
    protected $appends = ['completionPercentage'];
    public function tasks()
{
    return $this->hasMany(Task::class);
}
    public function getCompletionPercentageAttribute()
    {
        $totalTasks = $this->tasks->count();
        $completedTasks = $this->tasks->where('status_task', 'Selesai')->count();

        if ($totalTasks > 0) {
            return ($completedTasks / $totalTasks) * 100;
        } else {
            return 0; // Hindari pembagian oleh nol jika tidak ada tugas dalam proyek.
        }
    }
}
