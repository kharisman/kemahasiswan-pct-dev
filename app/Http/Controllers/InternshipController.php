<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectUpdate;
use App\Models\ProjectApply;
use App\Models\AccountLink;
use App\Models\Project;
use App\Models\Internship;
use App\Models\Iduka;
use App\Models\Document;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class InternshipController extends Controller
{
    public function dashboardInternship(){
		$user_id = Internship::where('user_id', Auth::user()->id)->get('id');
		$completedProject = ProjectUpdate::whereNotNull('date_finish')
			->where('internship_id', $user_id)
			->count();
		$onGoingProject = ProjectUpdate::whereNull('date_finish')
			->where('internship_id', $user_id)
			->count();
		$rejectProject = ProjectApply::where('internship_id', $user_id)
			->where('status', 'reject')
			->count();
		$onGoingProjectData = ProjectUpdate::join('projects', 'project_updates.project_id', '=', 'projects.id')
			->whereNull('date_finish')
			->where('internship_id', $user_id)
			->get();
		return view('internship/index', compact('completedProject','onGoingProject','rejectProject','onGoingProjectData'));
	}
    public function projectInternship(){
		$id = Auth::user()->id;
		$internship = Internship::where('user_id', $id)->first();
		$projectData = Project::join('idukas','projects.iduka_id','=','idukas.id')->limit(10)->inRandomOrder()
			->get();
		return view('internship/project', compact('projectData', 'internship'));
	}
    public function projectInternshipPost(Request $r){
		$projectData = Project::join('idukas','projects.iduka_id','=','idukas.id')
		->where('projects.name','like',"%$r->search%")
		->orWhere('idukas.name','like',"%$r->search%")
		->get();
		return view('internship/project', compact('projectData'));
	}
    public function historyInternship(){
		$applyProjectData = ProjectApply::join('projects', 'project_applies.project_id', '=', 'projects.id')->select('project_applies.*','projects.name')->get();
		return view('internship/history', compact('applyProjectData'));
	}
    public function dataInternship(){
		return view('internship/data');
	}
    public function dataInternshipPost(Request $r){
		
		
		DB::beginTransaction();
		try {
			$validator = Validator::make($r->all(), [
				'name' => 'required|min:3|max:10',
				'date_of_birth' => 'required',
				'gender' => 'required',
				'address' => 'required',
				'photo' => 'required|mimes:jpg,jpeg,png',
				'nationality' => 'required',
				'education' => 'required',
				'interest' => 'required',
				'phone' => 'required',
				'application_letter' => 'mimes:pdf',
				'certificate' => 'mimes:pdf',
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

			$photo = $r->file('photo');
			$newPhoto = $id . $r->name."_photo.".$photo->getClientOriginalExtension();
			$photo->move('images/internship/',$newPhoto);
			$new =  Internship::findOrFail($dataId);
			$new->user_id = $id;
			$new->name = $r->name;
			$new->photo = $newPhoto;
			$new->gender = $r->gender;
			$new->date_of_birth = $r->date_of_birth;
			$new->address = $r->address;
			$new->nationality = $r->nationality;
			$new->education = $r->education;
			$new->interest = $r->interest;
			$new->phone = $r->phone;
			$new->update_at = now();
			$new->save();

			$mediaCount = 1;
			$dataToInsert = [];
		
			while ($r->has("name_account$mediaCount")) {
				$nameAccount = $r->input("name_account$mediaCount");
				$link = $r->input("link$mediaCount");
		
				if (!empty($nameAccount) && !empty($link)) {
					$dataToInsert[] = [
						'internship_id' => $dataId,
						'name_account' => $nameAccount,
						'link' => $link,
						'created_at' => now(),
					];
				}
		
				$mediaCount++;
			}
			if (!empty($dataToInsert)) {
				AccountLink::insert($dataToInsert);
			}
		
			
			if ($r->hasFile('application_letter') && $r->hasFile('certificate')) {
				$application_letter = $r->file('application_letter');
				$certificate = $r->file('certificate');
		
				if ($application_letter && $certificate) {
					$newApplicationLetter = $id . "_" . $r->name. "_application_letter." . $application_letter->getClientOriginalExtension();
					$application_letter->move('images/internship/', $newApplicationLetter);
				
					$newCertificate = $id . "_" . $r->name. "_certificate." . $certificate->getClientOriginalExtension();
					$certificate->move('images/internship/', $newCertificate);
				
					$newDocument = new Document;
					$newDocument->internship_id = $dataId;
					$newDocument->application_letter = $newApplicationLetter;
					$newDocument->certificate = $newCertificate;
					$newDocument->save();
				} else {
					return back()->with('error', 'File surat lamaran dan/atau sertifikat tidak ditemukan.');
				}
			}
		DB::commit();
		return redirect('internship-data')->with('success', 'Data Pribadi berhasil diperbarui. ');
		} catch (\Throwable $e) {
			DB::rollback();
			return back()->with('error', 'Data Pribadi gagal diperbarui. Coba kembali. Error: ');
		}
	}
    public function projectDetailInternship(Request $r, $id){
		$projectData = Project::join('idukas','projects.iduka_id','=','idukas.id')->findOrFail($id);
		
		return view('internship/detail_project', compact('projectData'));
	}
	public function applyProjectInternship(Request $r, $id){
		$id = Auth::user()->id;
		$data = Internship::where('user_id', $id)->first();
		$dataId = $data->id;
		$new = new ProjectApply;
		$new->project_id = $id;
		$new->internship_id = $dataId;
		$new->status = "";
		$new->created_at = now();
		$new->updated_at = null;
		$new->save();
		return redirect('internship-index')->with('success', 'Data lamaran berhasil dikirim. ');
	}
}