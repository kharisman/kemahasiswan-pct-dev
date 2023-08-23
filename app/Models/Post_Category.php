<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Category extends Model
{
    use HasFactory;
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function post(){
        return $this->hasOne(Post::class,'id','post_id');
    }
}
