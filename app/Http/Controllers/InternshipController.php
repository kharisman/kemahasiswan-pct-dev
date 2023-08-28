<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectUpdate;
use App\Models\ProjectApply;
use App\Models\AccountLink;
use App\Models\Project;
use App\Models\Internship;
use App\Models\Iduka;
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
		$onGoingProject = ProjectUpdate::where('date_finish','')
			->where('internship_id', $user_id)
			->count();
		$rejectProject = ProjectApply::where('internship_id', $user_id)
			->where('status', 'reject')
			->count();
		$onGoingProjectData = ProjectUpdate::join('projects', 'project_updates.project_id', '=', 'projects.id')
			->where('date_finish', '')
			->where('internship_id', $user_id)
			->get();
		return view('internship/index', compact('completedProject','onGoingProject','rejectProject','onGoingProjectData'));
	}
    public function projectInternship(){
		$projectData = Project::join('idukas','projects.iduka_id','=','idukas.id')
			->get();
		return view('internship/project', compact('projectData'));
	}
    public function historyInternship(){
		$applyProjectData = ProjectApply::get();
		return view('internship/history', compact('applyProjectData'));
	}
    public function dataInternship(){
		return view('internship/data');
	}
    public function dataInternshipPost(Request $r){
		$r->validate([
            'name' => 'required|min:3|max:10',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',
            'nationality' => 'required',
            'education' => 'required',
            'interest' => 'required',
            'phone' => 'required'
        ]);
		$user_id = Auth::user()->id;
		$dataId = Internship::where('user_id',$user_id)->get('id');
		$cekUser = Internship::where('user_id',$user_id)->get('user_id');
		if ($cekUser <> $user_id) {
			$photo = $r->file('photo');
			$newPhoto = uniqid().".".$photo->getClientOriginalExtension();
			$photo->move('images/internship',$newPhoto);
			$new = new Internship;
			$new->user_id = $user_id;
			$new->name = $r->name;
			$new->newPhoto = $r->newPhoto;
			$new->gender = $r->gender;
			$new->date_of_birth = $r->date_of_birth;
			$new->address = $r->address;
			$new->nationality = $r->nationality;
			$new->education = $r->education;
			$new->interest = $r->interest;
			$new->phone = $r->phone;
			$new->save();

			if (isset($r->link1) || isset($r->link2) ||isset($r->link3)) {
				$newAccountLink = new AccountLink;
				$newAccountLink->internship_id = $dataId;
				$newAccountLink->name_account = $r->name_account1;
				$newAccountLink->link = $r->link1;
				$newAccountLink->save();
			}
		}
		return redirect('internship/data');
	}
    public function detailProjectInternship(){
		return view('internship/detail');
	}
}
