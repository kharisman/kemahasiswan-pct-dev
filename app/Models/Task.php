<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'project_id', 'internship_id'];

    // Relasi ke model Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke model Internship
    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
    public function internships()
{
    return $this->belongsToMany(Internship::class);
    
}
}
