<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    

    public function categories(){
        return $this->hasMany(PostCategory::class,'post_id','id');
    }
}
