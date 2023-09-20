<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Iduka;
use App\Models\ProjectApply;
use App\Models\ProjectCategory;
use App\Models\ProjectUpdate;
use App\Models\ProjectProgress;
use App\Models\Internship;
use App\Models\InternshipsApply;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\Document;
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
            $project->status = "Aktif";
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
        $status_work = $request->status_work;

        $query = Project::where('iduka_id', $iduka->id);

        if (!empty($search)) {

            $query = $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($level)) {

            $query = $query->where('level', $level);
        }
        if (!empty($status_work)) {
            $query = $query->where('status_work', $status_work);
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
            $projectApplies = $projectApplies->where('project_id', $id);
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

    $documents = Document::where('internship_id', $projectApply->internship->id)
        ->where('created_at', '=', $projectApply->created_at) 
        ->get();

    return view('iduka/detail_pelamar', compact('projectApply', 'iduka', 'documents'));
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

    public function ongoingProgressByProject($id)
    {
        $iduka = Auth::user()->iduka;
        $project = Project::findOrFail($id);
        $projectUpdates = ProjectUpdate::with(['project', 'internship'])
            ->where('project_id', $id)
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
            'groupedUpdates' => $groupedUpdates,
            'project'=>$project
        ]);
    }

    public function createTask($project_id)
    {
        try {
            $project = Project::findOrFail($project_id);
            $iduka = Auth::user()->iduka;
            $internships = Internship::all();
    
            $groupedUpdates = ProjectUpdate::with(['project', 'internship'])
                ->where('project_id', $project_id)
                ->get();
    
            $projectApplies = ProjectApply::with(['project', 'internship'])
                ->whereHas('project', function ($query) use ($iduka) {
                    $query->where('iduka_id', $iduka->id);
                })
                ->get();
    
            return view('iduka.create_task', compact('project', 'internships', 'iduka', 'groupedUpdates', 'projectApplies'));
        } catch (\Exception $e) {
            
            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function store(Request $request, $project_id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'internship_id' => 'required|array', 
                'internship_id.*' => 'integer|exists:internships,id',
            ]);

            $data['project_id'] = $project_id;

            $taskData = collect($data)->except('internship_id')->toArray();

            $task = Task::create($taskData);

            $task->internships()->attach($data['internship_id']);

            return back()->with('success', 'Tugas berhasil ditambahkan!');
        } catch (\Exception $e) {
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showTasksByProject($project_id)
    {
        try {
            $project = Project::findOrFail($project_id);
            $tasks = Task::where('project_id', $project_id)->get();
            $iduka = Auth::user()->iduka;
            return view('iduka.show_task', compact('project', 'tasks', 'iduka'));
        } catch (\Exception $e) {
            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
        
    public function edit($task_id)
    {
        $task = Task::findOrFail($task_id);
        $iduka = Auth::user()->iduka;
        return view('iduka/tasks_edit', compact('task','iduka'));
        }
    public function update(Request $request, $task_id)
    {
        $data = $request->validate([
            'status_task' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($task_id);
        $task->status_task = $request->input('status_task');
        $task->save();

        return redirect()->route('tasks.byProject', ['project_id' => $task->project_id])
            ->with('success', 'Status task berhasil diperbarui!');
    }


    public function task_edit($task)
    {
        // return $task ;
        $task = Task::with("taskHistories")->findOrFail($task);
        $iduka = Auth::user()->iduka;
        return view('iduka/tasks_edit', compact('task','iduka'));
    }

    public function task_edit_p(Request $request, $task)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_task' => 'required|string',
        ]);

        try {
            // Memulai transaksi
            DB::beginTransaction();

            // Temukan tugas berdasarkan ID
            $task = Task::findOrFail($task);

            // Perbarui tugas dengan data yang divalidasi
            $task->update($validatedData);

            $taskHistory = new TaskHistory();
            $taskHistory->task_id = $task->id;
            $taskHistory->user_id = auth()->user()->id; 
            $taskHistory->description = $task->description;
            $taskHistory->save();
            DB::commit();
            
            // return $task ;
            return back()->with('success', 'Tugas berhasil diperbarui!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            return back()->with('error', 'Gagal memperbarui tugas: ' . $e->getMessage());
        }
    }

    public function editStatusWork($projectId)
    {   
        try {
            $iduka = Auth::user()->iduka;
            $project = Project::findOrFail($projectId);
            return view('iduka/edit_status_work', compact('project', 'iduka'));
        } catch (\Exception $e) {

            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatusWork(Request $request, $projectId)
    {
        try {
            $data = $request->validate([
                'status_work' => 'required|string|max:255',
            ]);
            $project = Project::findOrFail($projectId);
            $project->status_work = $data['status_work'];
            $project->save();
            return redirect()->route('iduka.index')->with('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function calculateTask()
    {
        try {
            $projects = Project::with('tasks')->get();
    
            foreach ($projects as $project) {
                $totalTasks = $project->tasks->count();
    
                $completedTasks = $project->tasks->where('status_task', 'Selesai')->count();
    
                if ($totalTasks > 0) {
                    $completionPercentage = ($completedTasks / $totalTasks) * 100;
                } else {
                    $completionPercentage = 0; // Avoid division by zero if there are no tasks in the project.
                }
    
                $project->completionPercentage = $completionPercentage;
            }
    
            return view('iduka.index', compact('projects'));
        } catch (\Exception $e) {
           
            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function tambahNotes($id)
    {   
        try {
            $iduka = Auth::user()->iduka;
            $project = Project::findOrFail($id);
            return view('iduka.tambahNotes', compact('project', 'iduka'));
        } catch (\Exception $e) {
  
            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function storeNotes(Request $request, $id)
    {
        try {
            $progress = new ProjectProgress;
            $progress->project_id = $id; 
            $progress->notes = $request->input('notes');
            $progress->save();
    
            return redirect()->route('iduka.index', ['id' => $id])->with('success', 'Catatan proyek berhasil disimpan.');
        } catch (\Exception $e) {
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showProjectDetails($projectId)
    {
        try {
            $iduka = Auth::user()->iduka;
            $project = Project::findOrFail($projectId);
            $categories = ProjectCategory::get();
            return view('iduka.project_details', compact('project', 'iduka','categories'));
        } catch (\Exception $e) {
           
            return view('error.page')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
