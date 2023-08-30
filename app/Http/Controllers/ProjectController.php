<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 

class ProjectController extends Controller
{
    public function create_project()
    {
        $categories = ProjectCategory::all();
        return view('iduka/recruitment', ['categories' => $categories]);
    }

    public function saveProject(Request $request)
    {
        $data = $request->validate([

            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required',
        ]);
        $data['iduka_id'] = Auth::user()->id;
        $project = new Project();
        $project->iduka_id = $data['iduka_id'];
        $project->name = $data['name'];
        $project->status = 'aktif';
        $project->category_id = $data['category_id'];
        // Menyimpan konten Summernote
        $notesContent = $data['notes'] ?? '';
        $summernoteContent = $data['content'] ?? '';
        $combinedContent = $notesContent . "\n" . $summernoteContent;
        $project->notes = $combinedContent;

        preg_match_all('/<img[^>]+src="([^"]+)"/', $summernoteContent, $imageMatches);
        foreach ($imageMatches[1] as $imageSrc) {
            if (Str::startsWith($imageSrc, 'data:image')) {
                $extension = explode('/', mime_content_type($imageSrc))[1];
                $filename = 'summernote/' . Str::random(40) . '.' . $extension;
                $imageData = base64_decode(preg_replace('/data:image\/(.*?);base64,/', '', $imageSrc));
                Storage::disk('public')->put($filename, $imageData);
                $combinedContent = str_replace($imageSrc, asset('storage/' . $filename), $combinedContent);
            }
        }

        $project->notes = $combinedContent;

        // Simpan data proyek
        $project->save();
    
        return redirect()->route('iduka.index')->with('success', 'Project created successfully.');
    }

        public function editProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $categories = ProjectCategory::all();
        return view('iduka.edit', compact('project', 'categories'));
    }

    public function updateProject(Request $request, $projectId)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required',
        ]);

        $project = Project::findOrFail($projectId);
        $project->name = $data['name'];
        $project->status = $data['status'];
        $project->category_id = $data['category_id'];

        $notesContent = $data['notes'] ?? '';
        $summernoteContent = $data['content'] ?? '';
        $combinedContent = $notesContent . "\n" . $summernoteContent;

        preg_match_all('/<img[^>]+src="([^"]+)"/', $summernoteContent, $imageMatches);
        foreach ($imageMatches[1] as $imageSrc) {
            if (Str::startsWith($imageSrc, asset('storage/'))) {
                continue; // Ignore existing images
            }
            if (Str::startsWith($imageSrc, 'data:image')) {
                $extension = explode('/', mime_content_type($imageSrc))[1];
                $filename = 'summernote/' . Str::random(40) . '.' . $extension;
                $imageData = base64_decode(preg_replace('/data:image\/(.*?);base64,/', '', $imageSrc));
                Storage::disk('public')->put($filename, $imageData);
                $combinedContent = str_replace($imageSrc, asset('storage/' . $filename), $combinedContent);
            }
        }

        $project->notes = $combinedContent;
        $project->save();

        return redirect()->route('iduka.index', ['id' => $projectId])->with('success', 'Project updated successfully.');
    }


        public function editStatus($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('iduka/edit_status', compact('project'));
    }

    public function updateStatus(Request $request, $projectId)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($projectId);

        // Update the project's status
        $project->status = $data['status'];
        $project->save();

        return redirect()->route('iduka.index')->with('success', 'Status updated successfully.');
    }
    
    public function all_project()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();
        $projects = Project::where('iduka_id', $user->id)->get();
    
        return view('iduka/project', compact('projects', 'categories'));
    }

    public function pending_project()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();

        $projects = Project::where('iduka_id', $user->id)
                        ->where('status', 'pending')
                        ->get();

        return view('iduka/pending_project', compact('projects', 'categories'));
    }

    public function selesai_project()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();

        $projects = Project::where('iduka_id', $user->id)
                        ->where('status', 'selesai')
                        ->get();

        return view('iduka/selesai_project', compact('projects', 'categories'));
    }

    public function aktif_project()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();

        $projects = Project::where('iduka_id', $user->id)
                        ->where('status', 'aktif')
                        ->get();

        return view('iduka/aktif_project', compact('projects', 'categories'));
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

        return redirect()->route('iduka.index')->with('success', 'Project deleted successfully.');
    }
}
