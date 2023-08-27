<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Iduka;
use App\Models\Internship;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Project_Category;
use App\Models\Post;

class adminController extends Controller
{
    //
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
        $data = User::get();
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
        $r->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp',
        ]);
        $photo = $r->file('photo');
        $newPhoto = uniqid().".".$photo->getClientOriginalExtension();
        $photo->move('images',$newPhoto);

        $new = new Slider();
        $new->photo = $newPhoto;
        $new->save();
        $r->session()->flash('message','Data Berhasil Disimpan.');
        return redirect('admin/add_slider');
    }
    public function addCategory(){
        return view('admin/add_category');
    }
    public function addCategoryPost(Request $r){
        $r->validate([
            'name' => 'required|min:3|max:10'
        ]);

        $new = new Category();
        $new->name = $r->name;
        $new->save();
        $r->session()->flash('message','Data Berhasil Disimpan.');
        return redirect('admin/add_category');
    }
    public function addPost(){
        return view('admin/add_post');
    }
    public function addPostPost(Request $r){
        $r->validate([
            'title' => 'required|min:3|max:10',
            'content' => 'required|min:15|max:100'
        ]);

        $new = new Post();
        $new->title = $r->title;
        $new->content = $r->content;
        $new->save();
        $r->session()->flash('message','Data Berhasil Disimpan.');
        return redirect('admin/add_post');
    }
    public function addCategoryProject(){
        return view('admin/add_category_project');
    }
    public function addCategoryProjectPost(Request $r){
        $r->validate([
            'category' => 'required|min:3|max:25'
        ]);

        $new = new Project_Category();
        $new->category = $r->category;
        $new->save();
        $r->session()->flash('message','Data Berhasil Disimpan.');
        return redirect('admin/add_category_project');
    }
}
