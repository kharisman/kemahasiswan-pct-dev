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
use App\Models\PostCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function slider(){
        $data = Slider::orderBy("sort","desc")->get();
        // return $data ;
        return view('admin.slider.data',compact('data')) ;
    }

    public function slider_add(){
        return view('admin.slider.add') ;
    }

    public function slider_add_p(Request $request){
        
        $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sort' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak',
        ]);
    
        if ($request->hasFile('images')) {
            // Get the uploaded image file
            $image = $request->file('images');

            // Set the desired width and height
            $width = 1200;
            $height = 500;

            // Set the storage path for the new image
            $publicPath = 'assets/images/slider/';

            // Generate a unique filename for the new image
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Create a new instance of Intervention Image
            $image = Image::make($image);

            // Resize the image while maintaining aspect ratio
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path($publicPath . $filename));
            $url = asset($publicPath . $filename);
        } else {
            // No image was uploaded, set the URL to null or a default value
            $url = null;
            $filename = null;
        }

        Slider::create([
            'images' => $url,
            'sort' => $request->sort,
            'status' => $request->status,
        ]);

    
        return back()->with('success', 'Slider berhasil ditambahkan.');
    }

    public function slider_edit(Request $request){
        
        $d = Slider::where("id",$request->id)->firstOrFail();
        return view('admin.slider.edit', compact('d')) ;
    }


    public function slider_edit_p(Request $request) {
        $request->validate([
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sort' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak',
        ]);
    
        $slider = Slider::findOrFail($request->id);
    
        if ($request->hasFile('images')) {
            // Get the uploaded image file
            $image = $request->file('images');
    
            // Set the desired width and height
            $width = 1200;
            $height = 500;
    
            // Set the storage path for the new image
            $publicPath = 'assets/images/slider/';
    
            // Generate a unique filename for the new image
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Create a new instance of Intervention Image
            $image = Image::make($image);
    
            // Resize the image while maintaining aspect ratio
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path($publicPath . $filename));
            $url = asset($publicPath . $filename);
    
            // Delete the old image if it exists
            if ($slider->images && file_exists(public_path($slider->images))) {
                unlink(public_path($slider->images));
            }
    
            $slider->images = $url;
        }
    
        $slider->sort = $request->sort;
        $slider->status = $request->status;
        $slider->save();
    
        return back()->with('success', 'Slider berhasil diperbarui.');
    }

    public function slider_delete_p(Request $request) {
        $sliderId = $request->id;
        
        $slider = Slider::find($sliderId);
    
        if ($slider) {
            // Delete the associated image from storage if it exists
            if ($slider->images && file_exists(public_path($slider->images))) {
                unlink(public_path($slider->images));
            }
    
            $slider->delete();
            return back()->with('success', 'Slider berhasil dihapus.');
        } else {
            return back()->with('error', 'Slider tidak ditemukan.');
        }
    }

    public function kategori_berita(){
        $data = Category::get();
        return view('admin.kategori.data',compact('data')) ;
    }

    public function kategori_berita_add(){
        return view('admin.kategori.add') ;
    }

    public function kategori_berita_add_p(Request $request){
        
        // return $request->nama ;
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,name,NULL,id,deleted_at,NULL',
            'status' => 'required|in:Aktif,Tidak',
        ]);

        $save  = New Category() ;
        $save->name = $request->nama;
        $save->status = $request->status;
        $save->save() ;

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategori_berita_edit(Request $request){
        
        $d = Category::where("id",$request->id)->firstOrFail();
        return view('admin.kategori.edit',compact('d')) ;
    }

    public function kategori_berita_edit_p(Request $request){
        
        // return $request->nama ;
        
        $save  = Category::where("id",$request->id)->firstOrFail() ;


        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,name,' . $save->id . ',id,deleted_at,NULL',
            'status' => 'required|in:Aktif,Tidak',
        ]);

        $save->name = $request->nama;
        $save->status = $request->status;
        $save->save() ;

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategori_berita_delete_p(Request $request){
        
        $save  = Category::where("id",$request->id)->firstOrFail() ;
        $save->delete() ;

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }


    public function berita(){
        $data = Post::with("categories.category")->get();
        return view('admin.berita.data',compact('data')) ;
    }

    public function berita_add(){
        $kat = Category::where("status","Aktif")->get();
        // return $kat ;
        return view('admin.berita.add',compact('kat')) ;
    }

    public function berita_add_p(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:5',
            'konten' => 'required|min:5'
        ]);
        

       DB::beginTransaction();
       try {
        $description = $request->konten;
        
        // return $scoring_scale;
        if (!empty($description)){
            $dom = new \DomDocument();
            @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);   
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name= "/assets/images/post/" . time().$k.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $description = $dom->saveHTML();
        }
        $save = New Post ();
        $save->title = $request->judul;
        $save->content = ($description);
        $save->status = $request->status;
        $save->updated_at = null;
        $save->save();
        if (!$save){
            DB::rollback();
            return back()->with('error', 'Data Berita gagal disimpan. Coba kembali ');
        }
        foreach ($request->kategori as $value) {
            $category = New PostCategory(); // Ganti dengan metode yang sesuai untuk mengambil kategori berdasarkan nilai
            
            $category->category_id = $value; // Pastikan Anda telah mengatur relasi di model Post
            $category->post_id = $save->id ; // Pastikan Anda telah mengatur relasi di model Post
            $category->save(); // Pastikan Anda telah mengatur relasi di model Post
            
        }


       } catch (\Throwable $th) {
        DB::rollback();
        dd($th);
        return back()->with('error', 'Data Berita gagal disimpan. Coba kembali ');
       }
       DB::commit();
        return back()->with('success', 'Data Berita berhasil disimpan. ');
    }

    public function berita_edit(Request $request){
        $kat = Category::where("status","Aktif")->get();
        $d = Post::with("categories.category")->where("id",$request->id)->firstOrFail();
        // return $kat ;
        return view('admin.berita.edit',compact('kat','d')) ;
    }

    public function berita_edit_p(Request $request)
    {

        
        $save = Post::where("id",$request->id)->firstOrFail();


        $this->validate($request, [
            'judul' => 'required|min:5',
            'konten' => 'required|min:5'
        ]);
        

       DB::beginTransaction();
       try {
        $description = $request->konten;
        
        // return $scoring_scale;
        if (!empty($description)){
            $dom = new \DomDocument();
            @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);   
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $data = $img->getAttribute('src');

                
                if ( !strstr( $data, 'post' ) ) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name= "/assets/images/post/" . time().$k.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);

                } else {

                }
            }
            $description = $dom->saveHTML();
        }
        $save->title = $request->judul;
        $save->content = ($description);
        $save->status = $request->status;
        $save->updated_at = null;
        $save->save();
        if (!$save){
            DB::rollback();
            return back()->with('error', 'Data Berita gagal diperbarui. Coba kembali ');
        }
        
        PostCategory::where("post_id",$save->id)->delete();
        foreach ($request->kategori as $value) {
            $category = New PostCategory(); // Ganti dengan metode yang sesuai untuk mengambil kategori berdasarkan nilai
            
            $category->category_id = $value; // Pastikan Anda telah mengatur relasi di model Post
            $category->post_id = $save->id ; // Pastikan Anda telah mengatur relasi di model Post
            $category->save(); // Pastikan Anda telah mengatur relasi di model Post
            
        }


       } catch (\Throwable $th) {
        DB::rollback();
        dd($th);
        return back()->with('error', 'Data Berita gagal diperbarui. Coba kembali ');
       }
       DB::commit();
        return back()->with('success', 'Data Berita berhasil diperbarui. ');
    }


    public function berita_delete_p(Request $request)
    {

        
    $save = Post::where("id",$request->id)->firstOrFail();


       DB::beginTransaction();
       try {
        PostCategory::where("post_id",$request->id)->delete();
        $save->delete();
        if (!$save){
            DB::rollback();
            return back()->with('error', 'Data Berita gagal dihapus. Coba kembali ');
        }


       } catch (\Throwable $th) {
        DB::rollback();
        dd($th);
        return back()->with('error', 'Data Berita gagal dihapus. Coba kembali ');
       }
       DB::commit();
        return back()->with('success', 'Data Berita berhasil disimpan. ');
    }
    
}
