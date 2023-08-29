<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        preg_match_all('/<img[^>]+src="([^"]+)"/', $project->notes, $imageMatches);
        foreach ($imageMatches[1] as $imageSrc) {
            if (Str::startsWith($imageSrc, asset('storage'))) {
                $imagePath = str_replace(asset('storage/'), '', $imageSrc);
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete the project
        $project->delete();

        return redirect()->route('iduka/index')->with('success', 'Project deleted successfully.');
    }
}
