<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProjectController extends Controller
{
    public function create_project()
    {
        return view('iduka/recruitment');
    }

    public function saveProject(Request $request)
{
    $data = $request->validate([
        'iduka_id' => 'required',
        'name' => 'required|string|max:255',
        'notes' => 'nullable|string',
        'content' => 'nullable|string', // Field baru untuk konten Summernote
    ]);

    $project = new Project();
    $project->iduka_id = $data['iduka_id'];
    $project->name = $data['name'];

    // Menyimpan konten Summernote
    $notesContent = $data['notes'] ?? '';
    $summernoteContent = $data['content'] ?? '';
    $combinedContent = $notesContent . "\n" . $summernoteContent;
    $project->notes = $combinedContent;

    // Menyimpan gambar yang diunggah melalui Summernote
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

    return redirect()->route('create_project')->with('success', 'Project created successfully.');
}
}
