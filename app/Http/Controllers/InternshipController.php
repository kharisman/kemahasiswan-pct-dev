<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectUpdate;
use App\Models\ProjectApply;
use App\Models\ProjectCategory;
use App\Models\AccountLink;
use App\Models\Project;
use App\Models\Internship;
use App\Models\Iduka;
use App\Models\Document;
use App\Models\SocialMediaLink;
use App\Models\ProjectProgress;
use App\Models\Task;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class InternshipController extends Controller
{
	public function __construct()
    {	
		$this->middleware('auth');
		$this->middleware(function ($request, $next) {
			// dd(auth()->user()->roles);
			if (auth()->user()->roles !== 'internship') {
				abort(403, 'Unauthorized'); // Jika pengguna bukan "internship", kembalikan kode 403 (Akses Ditolak)
			}
			return $next($request);
		});
    
    }
    public function dashboardInternship(){
		// Mendapatkan tanggal saat ini
		
		$today = Carbon::now()->toDateString();

		$id = Auth::user()->id;
		$data = Internship::where('user_id', $id)->first();
		$dataId = $data->id;

			// Mendapatkan catatan dari tabel project_applies yang memenuhi kriteria
			$acceptedApplies = DB::table('project_applies')
				->join('projects', 'project_applies.project_id', '=', 'projects.id')
				->where('project_applies.status', 'accepted')
				->where('project_applies.internship_id', $dataId)
				->whereDate('projects.work_start_at', '<=', $today)
				->whereDate('projects.work_end_at', '>=', $today)
				->select('project_applies.project_id', 'project_applies.internship_id')
				->get();
			
			// Menyalin data ke tabel project_updates
			foreach ($acceptedApplies as $apply) {
				    // Memeriksa apakah data sudah ada dalam tabel project_updates
					$existingUpdate = DB::table('project_updates')
					->where('project_id', $apply->project_id)
					->where('internship_id', $apply->internship_id)
					->first();
			
				// Jika data belum ada, maka baru disimpan
				if (!$existingUpdate) {
					DB::table('project_updates')->insert([
						'project_id' => $apply->project_id,
						'internship_id' => $apply->internship_id,
						'date_start' => DB::raw("(SELECT work_start_at FROM projects WHERE id = $apply->project_id)"),
						'date_finish' => DB::raw("(SELECT work_end_at FROM projects WHERE id = $apply->project_id)"),
					]);
				}
			}	

			$completedProject = ProjectUpdate::join('projects','project_updates.project_id','=','projects.id')
				->where('status_work', 'Selesai')
				->where('internship_id', $dataId)
				->count();
			$onGoingProject = ProjectUpdate::where('date_finish','>=',$today)
				->where('date_start','<=',$today)
				->where('internship_id', $dataId)
				->count();
			$rejectProject = ProjectApply::where('internship_id', $dataId)
				->where('status', 'rejected')
				->count();
			$onGoingProjectData = ProjectUpdate::join('projects','project_updates.project_id','=','projects.id')
				->select('project_updates.*', 'projects.name')
				->where('date_start','<=',$today)
				->where('date_finish','>=',$today)
				->where('internship_id', $dataId)
				->get();
			
		return view('internship/index', compact('completedProject','onGoingProject','rejectProject','onGoingProjectData'));
	}
    public function progressInternship($id){
		$idIntership = Auth::user()->id;
		$data = Internship::where('user_id', $idIntership)->first();
		$dataId = $data->id;
		$projectData = Project::findOrFail($id);
		$progressData = ProjectProgress::where('project_id',$id)->get();
		// return $progressData ;
		$taskData = Task::with("taskHistories")->with("internships")
		->where("project_id",$id)
		->whereHas("internships", function ($query) use ($data) {
			$query->where("internship_id",$data->id);
		})
		->orderby("id", "DESC")
		->get();

		return view('internship/progress', compact('projectData','progressData','taskData','dataId'));
	}
    public function projectInternship(){
		$today = Carbon::now()->toDateString();
		$id = Auth::user()->id;
		$internship = Internship::where('user_id', $id)->first();
		$categoryProjectData = ProjectCategory::where('status','Aktif')->get();
		$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.address', 'idukas.photo','projects.views')
			->join('idukas','projects.iduka_id','=','idukas.id')
			->join('project_categories','projects.category_id','=','project_categories.id')
			->whereDate('registration_start_at', '<=', $today)
    		->whereDate('registration_end_at', '>=', $today)
			->where('projects.status','Aktif')
			->where('projects.status_work','Belum Dimulai')
			->get();
		return view('internship/project', compact('projectData', 'internship','categoryProjectData'));
	}
    public function projectInternshipPost(Request $r){
		$today = Carbon::now()->toDateString();
		$id = Auth::user()->id;
		$data = $r->filter;
		$search = $r->search;
		$category = $r->category;
		if ($data == "new") {
			$dataFilter = "registration_start_at";
		}elseif ($data == "best") {
			$dataFilter = "views";
		}
		$internship = Internship::where('user_id', $id)->first();
		$categoryProjectData = ProjectCategory::where('status','Aktif')->get();
		if ($data <> "" && !$category) {
			$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.photo','projects.views')
				->join('idukas','projects.iduka_id','=','idukas.id')
				->join('project_categories','projects.category_id','=','project_categories.id')
				->whereDate('registration_start_at', '<=', $today)
				->whereDate('registration_end_at', '>=', $today)
				->where('projects.status','Aktif')
				->where('projects.status_work','Belum Dimulai')
				->orderBy($dataFilter, 'desc')
				->get();
		}elseif ($data <> "" && $category) {
			$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.photo','projects.views')
				->join('idukas','projects.iduka_id','=','idukas.id')
				->join('project_categories','projects.category_id','=','project_categories.id')
				->whereDate('registration_start_at', '<=', $today)
				->whereDate('registration_end_at', '>=', $today)
				->where('projects.status','Aktif')
				->where('category', $category)
				->where('projects.status_work','Belum Dimulai')
				->orderBy($dataFilter, 'desc')
				->get();
		}elseif ($category) {
			$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.photo','projects.views')
				->join('idukas','projects.iduka_id','=','idukas.id')
				->join('project_categories','projects.category_id','=','project_categories.id')
				->whereDate('registration_start_at', '<=', $today)
				->whereDate('registration_end_at', '>=', $today)
				->where('category', $category)
				->where('projects.status','Aktif')
				->where('projects.status_work','Belum Dimulai')
				->get();
		}elseif ($search) {
			$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.address', 'idukas.photo','projects.views')
				->join('idukas','projects.iduka_id','=','idukas.id')
				->join('project_categories','projects.category_id','=','project_categories.id')
				->where('projects.name','like',"%$r->search%")
				->orWhere('idukas.name','like',"%$r->search%")
				->whereDate('registration_start_at', '<=', $today)
				->whereDate('registration_end_at', '>=', $today)
				->where('projects.status','Aktif')
				->where('projects.status_work','Belum Dimulai')
				->get();
		}else {
			$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.address', 'idukas.photo','projects.views')
				->join('idukas','projects.iduka_id','=','idukas.id')
				->join('project_categories','projects.category_id','=','project_categories.id')
				->whereDate('registration_start_at', '<=', $today)
				->whereDate('registration_end_at', '>=', $today)
				->where('projects.status','Aktif')
				->where('projects.status_work','Belum Dimulai')
				->get();
		}
		return view('internship/project', compact('projectData', 'internship','categoryProjectData'));
	}
    public function historyInternship(){
		
		$id = Auth::user()->id;
		$internship = Internship::where('user_id', $id)->first();
		$applyProjectData = ProjectApply::join('projects', 'project_applies.project_id', '=', 'projects.id')
		->where("internship_id",$internship->id)
		->select('project_applies.*','projects.name','projects.work_end_at')->get();
		return view('internship/history', compact('applyProjectData'));
	}
    public function dataInternship(){
		
		$id = Auth::user()->id;
		$internship = Internship::where('user_id', $id)->first();
		// return $internship ;
		return view('internship.data', compact('internship'));
	}
    public function dataInternshipPost(Request $r)
	{
		DB::beginTransaction();
		try {
			$validator = Validator::make($r->all(), [
				'name' => 'required|min:3|max:225',
				'date_of_birth' => 'required',
				'gender' => 'required',
				'address' => 'required',
				'photo' => 'nullable|mimes:jpg,jpeg,png',
				'nationality' => 'required',
				'education' => 'required',
				'interest' => 'required',
				'phone' => 'required',
				'curriculum_vitae' => 'required|mimes:pdf',
				'certificate' => 'required|mimes:pdf',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$id = Auth::user()->id;
			$data = Internship::where('user_id', $id)->first();
			if (!$data) {
				return back()->with('error', 'Data Pribadi tidak ditemukan.');
			}
			$dataId = $data->id;

			// Mengunggah foto profil

			
			$new = Internship::findOrFail($dataId);
			
			if ($r->hasFile('photo')) {
			$photo = $r->file('photo');
			$newPhoto = $id . $r->name . "_photo." . $photo->getClientOriginalExtension();
			$photo->move('images/internship/', $newPhoto);
			$new->photo = $newPhoto;

			}
			// Mengupdate data Pribadi
			$new->user_id = $id;
			$new->name = $r->name;
			$new->gender = $r->gender;
			$new->date_of_birth = $r->date_of_birth;
			$new->address = $r->address;
			$new->nationality = $r->nationality;
			$new->education = $r->education;
			$new->interest = $r->interest;
			$new->phone = $r->phone;
			$new->instagram = $r->input('instagram');
			$new->linkedin = $r->input('linkedin');
			$new->github = $r->input('github');
			$new->updated_at = date("Y-m-d H:i:s");
			$new->save();

			

			// Mengunggah cv dan sertifikat
			if ($r->hasFile('curriculum_vitae') && $r->hasFile('certificate')) {
				$curriculum_vitae = $r->file('curriculum_vitae');
				$certificate = $r->file('certificate');

				if ($curriculum_vitae && $certificate) {
					$newCurriculumVitae = $id . "_" . $r->name . "_curriculum_vitae." . $curriculum_vitae->getClientOriginalExtension();
					$curriculum_vitae->move('images/internship/', $newCurriculumVitae);

					$newCertificate = $id . "_" . $r->name . "_certificate." . $certificate->getClientOriginalExtension();
					$certificate->move('images/internship/', $newCertificate);

					// Menyimpan data cv dan sertifikat
					$newDocument = new Document;
					$newDocument->internship_id = $dataId;
					$newDocument->curriculum_vitae = $newCurriculumVitae;
					$newDocument->application_letter = "";
					$newDocument->certificate = $newCertificate;
					$newDocument->save();
				} else {
					return back()->with('error', 'File CV dan/atau sertifikat tidak ditemukan.');
				}
			}

			DB::commit();
			return redirect('internship-data')->with('success', 'Data Pribadi berhasil diperbarui.');
		} catch (\Throwable $e) {
			dd($e);
			DB::rollback();
			return back()->with('error', 'Data Pribadi gagal diperbarui. Coba kembali. Error: ' . $e->getMessage());
		}
	}

    public function projectDetailInternship(Request $r, $id){
		$projectData = Project::select('projects.*','project_categories.category', 'idukas.name as idukaName', 'idukas.address')
			->join('idukas','projects.iduka_id','=','idukas.id')
			->join('project_categories','projects.category_id','=','project_categories.id')
			->findOrFail($id);
		
		return view('internship/detail_project', compact('projectData'));
	}

	public function applyProjectInternship(Request $r, $id){
		$userId = Auth::user()->id;
		$projectId = Project::findOrFail($id);
		return view('internship/apply_project', compact('projectId'));
	}

	public function applyProjectInternshipPost(Request $r){
		DB::beginTransaction();
		try {
			$validator = Validator::make($r->all(), [
				'projectId' => 'required',
				'application_letter' => 'required|mimes:pdf',
				'curriculum_vitae_new' => 'mimes:pdf',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$id = Auth::user()->id;
			$data = Internship::where('user_id', $id)->first();
			$dataId = $data->id;	
			$projectId = $r->projectId;

			// Mengunggah surat lamaran
			if ($r->hasFile('application_letter')) {
				$application_letter = $r->file('application_letter');
				$newapplication_letter = $id . "_application_letter_apply." . $application_letter->getClientOriginalExtension();
				$application_letter->move('images/internship/', $newapplication_letter);
			} else {
				return back()->with('error', 'File surat lamaran tidak ditemukan.');
			}

			// Mengunggah Curriculum Vitae (CV) baru jika checkbox dicentang
			if ($r->has('curriculum_vitae')) {
				if ($r->hasFile('curriculum_vitae_new')) {
					$curriculum_vitae_new = $r->file('curriculum_vitae_new');
					$newCurriculumVitae = $id . $projectId . "_curriculum_vitae_apply." . $curriculum_vitae_new->getClientOriginalExtension();
					$curriculum_vitae_new->move('images/internship/', $newCurriculumVitae);
				} else {
					// Jika checkbox dicentang, tetapi tidak ada file CV yang diunggah,
					// gunakan CV lama
					$documentData = Document::where('internship_id', $dataId)->first();
					$newCurriculumVitae = $documentData->curriculum_vitae;
				}
			} else {
				// Jika checkbox tidak dicentang, gunakan CV lama
				$documentData = Document::where('internship_id', $dataId)->first();
				$newCurriculumVitae = $documentData->curriculum_vitae;
			}

			// Mengupdate data dokumen
			$oldCertificate = $documentData->certificate;

			// Menyimpan data surat lamaran dan Curriculum Vitae (CV)
			$newDocument = new Document;
			$newDocument->internship_id = $dataId;
			$newDocument->application_letter = $newapplication_letter;
			$newDocument->curriculum_vitae = $newCurriculumVitae;
			$newDocument->certificate = $oldCertificate;
			$newDocument->save();

			// menubah data Project views
			$newProject = Project::findOrFail($projectId);
			$newProject->increment('views');
			$newProject->save();
				

				$existingData = ProjectApply::where('project_id', $projectId)
				->where('internship_id', $dataId)
				->first();

				if (!$existingData) {
					$new = new ProjectApply;
					$new->project_id = $projectId;
					$new->internship_id = $dataId;
					$new->status = "";
					$new->created_at = now();
					$new->updated_at = null;
					$new->save();
				} else {
					return redirect()->back()->with('error', 'Anda sudah mendaftar project ini sebelumnya.');
				}

				DB::commit();
			return redirect('internship-index')->with('successProject', 'Status project sedang di tinjau Mohon Cek Pesan secara berskala');
		} catch (\Throwable $e) {
			dd($e);
			DB::rollback();
			return back()->with('error', 'Data gagal dikirimkan. Coba kembali. Error: ' . $e->getMessage());
		}
	}
}
