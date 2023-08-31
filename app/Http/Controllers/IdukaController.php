<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Iduka;
use App\Models\User;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
class IdukaController extends Controller
{
    public function dashboard_iduka()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();
        $iduka = Iduka::where("user_id", Auth::user()->id)->firstOrFail();
        $projects = Project::where('iduka_id', $iduka->id)->get();
        $latestProject = Project::where('iduka_id', $iduka->id)->latest()->first();
        return view('iduka/index', compact('projects', 'categories', 'latestProject','iduka')); // Mengirim data projects dan categories ke tampilan
    }
    
    public function profile()
    {
        $iduka = Auth::user()->iduka;
        return view('iduka.profile', compact('iduka'));
    }

    public function edit($id)
    {
        $iduka = Iduka::findOrFail($id);
        return view('iduka.edit_profile', compact('iduka'));
    }    
    
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'nullable',
                'phone' => 'nullable',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate photo format and size
            ]);
    
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            DB::beginTransaction();
    
            $iduka = Iduka::findOrFail($id);
            $iduka->name = $request->name;
            $iduka->address = $request->address;
            $iduka->phone = $request->phone;
    
            if ($request->hasFile('photo')) {
                $new_photo = time() . '_' . Str::slug($request->file('photo')->getClientOriginalName());
                $request->file('photo')->move('images/iduka/', $new_photo);
                $iduka->photo = 'images/iduka/' . $new_photo;
            }
    
            $iduka->save();
    
            DB::commit();
    
            return redirect()->route('iduka.profile', $iduka->id)->with('success', 'Informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui informasi.');
        }
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
