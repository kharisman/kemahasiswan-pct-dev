<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
class IdukaController extends Controller
{
    public function dashboard_iduka()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();
        $projects = Project::where('iduka_id', $user->id)->get();
        $latestProject = Project::where('iduka_id', $user->id)->latest()->first();
    
        return view('iduka/index', compact('projects', 'categories', 'latestProject')); // Mengirim data projects dan categories ke tampilan
    }
    public function profile_iduka(){
        return view('iduka/profile');
    }


}
