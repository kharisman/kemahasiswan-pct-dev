<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Slider;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    public function carousel()
    {
        $Sliders = Slider::where("status", "Aktif")->OrderBy("sort", "ASC")->get();
        $new_posts = Post::with("categories.category")->where("status", "Aktif")->OrderBy("created_at", "DESC")->get();
        $pop_posts = Post::with("categories.category")->where("status", "Aktif")->OrderBy("views", "DESC")->get();
        $projects = Project::where("status", "Aktif")->with("iduka")->get();

        // return $new_posts ;
        return view('carousel', compact('Sliders', 'new_posts', 'pop_posts', 'projects'));
    }
}
