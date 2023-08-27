<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Project;
class IdukaController extends Controller
{
    public function dashboard_iduka()
    {
		//$iduka_id = Auth::user()->iduka_id;
        // Retrieve projects associated with the iduka_id
		$user = Auth::user();

    // Retrieve projects associated with the user's iduka_id
    $projects = Project::where('iduka_id', $user->id)->get();
		
        return view('iduka/index', compact('projects')); // Mengirim data projects ke tampilan
    }

}
