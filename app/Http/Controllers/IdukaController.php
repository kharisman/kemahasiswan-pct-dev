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
use Illuminate\Support\Facades\Hash;
use App\Models\ProjectApply; 

class IdukaController extends Controller
{

    public function __construct()
    {	
		$this->middleware('auth');
		$this->middleware(function ($request, $next) {
			// dd(auth()->user()->roles);
			if (auth()->user()->roles !== 'iduka') {
				abort(403, 'Unauthorized'); // Jika pengguna bukan "iduka", kembalikan kode 403 (Akses Ditolak)
			}
			return $next($request);
		});
    
    }
    public function dashboard_iduka()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();
        $iduka = Iduka::where("user_id", Auth::user()->id)->firstOrFail();
        $projects = Project::where('iduka_id', $iduka->id)->get();
        $latestProject = Project::where('iduka_id', $iduka->id)->latest()->take(3)->get();
        $projectsCount = Project::where('iduka_id', $iduka->id)->count();
        $applicantsCount = ProjectApply::whereHas('project', function ($query) use ($iduka) {
            $query->where('iduka_id', $iduka->id);
        })->count();
        $applicantsAcceptedCount = ProjectApply::whereHas('project', function ($query) use ($iduka) {
            $query->where('iduka_id', $iduka->id);
        })->where('status', 'accepted')->count();

        $applicantsRejectedCount = ProjectApply::whereHas('project', function ($query) use ($iduka) {
            $query->where('iduka_id', $iduka->id);
        })->where('status', 'rejected')->count();
        return view('iduka/index', compact('projects', 'categories', 'latestProject', 'iduka', 'projectsCount','applicantsCount','applicantsAcceptedCount', 'applicantsRejectedCount'));
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

    public function change_email_password()
    {
        $iduka = Auth::user()->iduka;
        return view('iduka.change_email_password', ['iduka' => $iduka]);
    }
    
    public function updateEmail(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,' . $user->id
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $user->update([
                'email' => $request->email
            ]);

            return redirect()->back()->with('success', 'Email berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui email.');
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();

            // Periksa validator yang hilang
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui password.');
        }
    }
}
