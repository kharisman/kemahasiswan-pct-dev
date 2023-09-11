<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Iduka;
use App\Models\ProjectApply;
use App\Models\ProjectCategory;
use App\Models\ProjectUpdate;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\UploadedFile;
class ProjectController extends Controller
{
    public function create_project()
    {   
        $categories = ProjectCategory::where("status","Aktif")->get();
        $iduka = Auth::user()->iduka;
        return view('iduka.recruitment', ['iduka' => $iduka, 'categories' => $categories]);
    }
    

    public function saveProject(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'required|string',
            'category_id' => 'required',
            'periode_pendaftaran' => [
                'required',
                'regex:/\d{4}-\d{2}-\d{2}\s*-\s*\d{4}-\d{2}-\d{2}/', // Format custom regex
            ],
            'periode_pengerjaan' => [
                'required',
                'regex:/\d{4}-\d{2}-\d{2}\s*-\s*\d{4}-\d{2}-\d{2}/', // Format custom regex
            ],
        ]);

        $periode_pendaftaran = explode(" - ", $data['periode_pendaftaran']);
        $periode_pengerjaan = explode(" - ", $data['periode_pengerjaan']);

        $iduka = Iduka::where("user_id", Auth::user()->id)->firstOrFail();

        try {
            DB::beginTransaction();

            $project = new Project();
            $project->iduka_id = $iduka->id;
            $project->name = $data['name'];
            $project->category_id = $data['category_id'];
            $project->level = $request->tingkat_Kesulitan;
            $project->registration_start_at = $periode_pendaftaran[0];
            $project->registration_end_at = $periode_pendaftaran[1];
            $project->work_start_at = $periode_pengerjaan[0];
            $project->work_end_at = $periode_pengerjaan[1];

            $description = $data['notes'];

            if (!empty($description)) {
                $dom = new \DomDocument();
                @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $k => $img) {
                    $data = $img->getAttribute('src');
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/assets/images/project/" . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
                $description = $dom->saveHTML();
            }

            $project->notes = $description;

            $project->save();

            DB::commit();

            return redirect()->route('iduka.index')->with('success', 'Proyek berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan proyek.');
        }
    }

    public function editProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $categories = ProjectCategory::all();
        $iduka = Auth::user()->iduka;
        return view('iduka.edit', compact('project', 'categories','iduka'));
    }


    public function updateProject(Request $request, $projectId)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'required|string',
            'category_id' => 'required',
            'periode_pendaftaran' => [
                'required',
                'regex:/\d{4}-\d{2}-\d{2}\s*-\s*\d{4}-\d{2}-\d{2}/', // Format custom regex
            ],
            'periode_pengerjaan' => [
                'required',
                'regex:/\d{4}-\d{2}-\d{2}\s*-\s*\d{4}-\d{2}-\d{2}/', // Format custom regex
            ],
        ]);

        $periode_pendaftaran = explode(" - ", $data['periode_pendaftaran']);
        $periode_pengerjaan = explode(" - ", $data['periode_pengerjaan']);

        $project = Project::findOrFail($projectId);

        try {
            DB::beginTransaction();

            $project->name = $data['name'];
            $project->category_id = $data['category_id'];
            $project->level = $request->tingkat_Kesulitan;
            $project->registration_start_at = $periode_pendaftaran[0];
            $project->registration_end_at = $periode_pendaftaran[1];
            $project->work_start_at = $periode_pengerjaan[0];
            $project->work_end_at = $periode_pengerjaan[1];

            $description = $data['notes'];

            if (!empty($description)) {
                $dom = new \DomDocument();
                @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $k => $img) {
                    $data = $img->getAttribute('src');

                    if ( !strstr( $data, 'project' ) ) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/assets/images/project/" . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                    }
                }
                $description = $dom->saveHTML();
            }

            $project->notes = $description;

            $project->save();

            DB::commit();

            return redirect()->route('iduka.index')->with('success', 'Proyek berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui proyek.');
        }
    }

        public function editStatus($projectId)
    {   
        $iduka = Auth::user()->iduka;
        $project = Project::findOrFail($projectId);
        return view('iduka/edit_status', compact('project','iduka'));
    }

    public function updateStatus(Request $request, $projectId)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($projectId);

        $project->status = $data['status'];
        $project->save();

        return redirect()->route('iduka.index')->with('success', 'Status updated successfully.');
    }
    
    public function all_project(Request $request)
    {
        $iduka = Auth::user()->iduka;
        $categories = ProjectCategory::all();

        $search = $request->input('search');
        $level = $request->level;
        $status_pengerjaan = $request->status_pengerjaan;

        $query = Project::where('iduka_id', $iduka->id);

        if (!empty($search)) {

            $query = $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($level)) {

            $query = $query->where('level', $level);
        }

        $projects = $query->get();

        return view('iduka.project', compact('projects', 'categories', 'iduka'));
    }

    public function pending_project()
    {
        $user = Auth::user();
        $iduka = Auth::user()->iduka;
        $categories = ProjectCategory::all();

        $projects = Project::where('iduka_id', $user->id)
                        ->where('status', 'pending')
                        ->get();

        return view('iduka/pending_project', compact('projects', 'categories','iduka'));
    }

    public function selesai_project(Request $request)
    {
        $iduka = Auth::user()->iduka;
        $categories = ProjectCategory::all();

        $search = $request->input('search');

        $query = Project::where('iduka_id', $iduka->id)
                        ->where('status', 'Tidak');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $projects = $query->get();

        return view('iduka.selesai_project', compact('projects', 'categories', 'iduka'));
    }
    
    public function aktif_project()
    {
        $user = Auth::user();
        $categories = ProjectCategory::all();
        $iduka = Auth::user()->iduka;
        $projects = Project::where('iduka_id', $iduka->id)
                        ->where('status', 'Aktif')
                        ->get();

        return view('iduka/aktif_project', compact('projects', 'categories','iduka'));
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

        $project->delete();

        return redirect()->route('iduka.index')->with('success', 'Project deleted successfully.');
    }
    
    public function data_apply(Request $request)
    {   
        $iduka = Auth::user()->iduka;
        $project_name = $request->project_name ;
        $status=$request->status ;
        $id=$request->id ;
        
        $projectApplies = ProjectApply::with(['project', 'internship'])
        ->whereHas('project', function ($query) use ($iduka) {
            $query->where('iduka_id', $iduka->id);
        });

        if (!empty($status)){
            if ($status=="3"){
                $projectApplies = $projectApplies->where("status","rejected");
            } else  if ($status=="2") {
                $projectApplies = $projectApplies->where("status","accepted");          
            } else {
                $projectApplies = $projectApplies->where("status","");
            }
        }

        if (!empty($project_name)) {
            $projectApplies = $projectApplies->whereHas('project', function ($query) use ($project_name) {
                $query->where('name', 'like', '%' . $project_name . '%');
            });
        }

        if (!empty($id)) {
            $projectApplies = $projectApplies->where('id', $id);
        }
  
  
         $projectApplies =    $projectApplies->get();
        
        return view('iduka.pelamar', [
            'iduka' => $iduka,
            'projectApplies' => $projectApplies
        ]);
    }

    public function data_apply_diterima()
    {   
        $iduka = Auth::user()->iduka;
        
        $projectApplies = ProjectApply::with(['project', 'internship'])
            ->whereHas('project', function ($query) use ($iduka) {
                $query->where('iduka_id', $iduka->id);
            })
            ->get();
        
        return view('iduka.status_diterima', [
            'iduka' => $iduka,
            'projectApplies' => $projectApplies
        ]);
    }
    public function data_apply_ditolak()
    {   
        $iduka = Auth::user()->iduka;
        
        $projectApplies = ProjectApply::with(['project', 'internship'])
            ->whereHas('project', function ($query) use ($iduka) {
                $query->where('iduka_id', $iduka->id);
            })
            ->get();
        
        return view('iduka.status_ditolak', [
            'iduka' => $iduka,
            'projectApplies' => $projectApplies
        ]);
    }

    public function detail_apply($projectApplyId)
    {
        $iduka = Auth::user()->iduka;
        $projectApply = ProjectApply::with(['project', 'internship'])->find($projectApplyId);
        
        return view('iduka/detail_pelamar', compact('projectApply', 'iduka'));
    }

    public function edit_status_apply(Request $request)
    {
        try {
            $newStatus = $request->input('new_status');

            $apply = ProjectApply::find($request->projectApplyId);

            if (!$apply) {
                return redirect()->back()->with('error', 'Pendaftaran tidak ditemukan');
            }

            DB::beginTransaction();

            $apply->status = $newStatus;
            $apply->save();

            DB::commit();

            return redirect()->back()->with('success', 'Status berhasil diperbarui');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    } 

    public function ongoing_progress()
    {   
        $iduka = Auth::user()->iduka;
        
        $projectUpdates = ProjectUpdate::with(['project', 'internship'])
            ->whereHas('project', function ($query) use ($iduka) {
                $query->where('iduka_id', $iduka->id);
            })
            ->get();

        $groupedUpdates = [];
        
        foreach ($projectUpdates as $update) {
            $projectId = $update->project_id;
            
            if (!isset($groupedUpdates[$projectId])) {
                $groupedUpdates[$projectId] = [
                    'project' => $update->project,
                    'internships' => []
                ];
            }
            
            $groupedUpdates[$projectId]['internships'][] = $update->internship->name;
        }
        
        return view('iduka.ongoing_progress', [
            'iduka' => $iduka,
            'groupedUpdates' => $groupedUpdates
        ]);
    }


public function showProjectApplies($projectId)
{
    $project = Project::findOrFail($projectId);
    $iduka = Auth::user()->iduka;

    $projectApplies = $project->applies;
    $projectApplies = ProjectApply::where('project_id', $projectId)->get();
    return view('iduka.project_apply', compact('project', 'projectApplies', 'iduka'));
}

}
