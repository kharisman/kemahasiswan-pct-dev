<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Iduka;
use App\Models\Internship;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Category;
use App\Models\ProjectCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth'); // Melindungi semua method dalam controller ini
    }

    
    public function adminDashboard(){
        $userCount = User::count();
        $idukaCount = Iduka::count();
        $internshipCount = Internship::count();
        $projectCount = Project::count();
        return view('admin/dashboard', compact('userCount', 'idukaCount', 'internshipCount', 'projectCount'));
    }
    public function adminArtikel(){
        $data = Slider::get();
        return view('admin/artikel', compact('data'));
    }
    public function adminConfirmIduka(){
        $data = User::where("roles","iduka")->get();
        return view('admin/confirm_iduka');
    }
    public function adminConfirmInternship(){
        $data = User::get();
        return view('admin/confirm_internship');
    }
    public function adminEvent(){
        $categoryData = Category::get();
        $postData = Post::get();
        return view('admin/event', compact('categoryData','postData'));
    }
    public function adminIduka(){
        $data = Iduka::get();
        return view('admin/iduka', compact('data'));
    }
    public function adminInternship(){
        $data = Internship::get();
        return view('admin/internship', compact('data'));
    }

    public function addSlider(){
        return view('admin/add_slider');
    }
    public function addSliderPost(Request $r){
        DB::beginTransaction();
        try {
        $validator = Validator::make($r->all(), [
            'image' => 'required|mimes:jpg,jpeg,png,webp'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $photo = $r->file('photo');
        $newPhoto = uniqid().".".$photo->getClientOriginalExtension();
        $photo->move('images',$newPhoto);

        $new = new Slider();
        $new->photo = $newPhoto;
        $new->save();
        DB::commit();
        return redirect('add-slider')->with('success', 'Registrasi Berhasil. Silahkan login');
        } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
        }
    }
    public function addCategory(){
        return view('admin/add_category');
    }
    public function addCategoryPost(Request $r){
        DB::beginTransaction();
        try {
        $validator = Validator::make($r->all(), [
            'name' => 'required|min:3|max:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $new = new Category();
        $new->name = $r->name;
        $new->save();
        DB::commit();
        return redirect('add-category')->with('success', 'Registrasi Berhasil. Silahkan login');
        } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
        }
    }
    public function addPost(){
        return view('admin/add_post');
    }
    public function addPostPost(Request $r){
        DB::beginTransaction();
        try {
        $validator = Validator::make($r->all(), [
            'title' => 'required|min:3|max:10',
            'content' => 'required|min:15|max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $new = new Post();
        $new->title = $r->title;
        $new->content = $r->content;
        $new->save();
        DB::commit();
        return redirect('add-post')->with('success', 'Registrasi Berhasil. Silahkan login');
        } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
        }
    }
    public function addCategoryProject(){
        $categoryProjectData = ProjectCategory::get();
        return view('admin/add_category_project',compact('categoryProjectData'));
    }
    public function addCategoryProjectPost(Request $r){
        DB::beginTransaction();
        try {
        $validator = Validator::make($r->all(), [
            'category' => 'required|min:3|max:25'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $new = new ProjectCategory();
        $new->category = $r->category;
        $new->save();
        DB::commit();
        return redirect('add-category-project')->with('success', 'Registrasi Berhasil. Silahkan login');
        } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
        }
    }
}
