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
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //

    public function __construct()
    {	
		$this->middleware('auth');
		$this->middleware(function ($request, $next) {
			// dd(auth()->user()->roles);
			if (auth()->user()->roles !== 'admin') {
				abort(403, 'Unauthorized'); // Jika pengguna bukan "admin", kembalikan kode 403 (Akses Ditolak)
			}
			return $next($request);
		});
    
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
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        if ($request->hasFile('images')) {
            // Get the uploaded image file
            $image = $request->file('images');

            // Set the desired width and height
            $width = 1200;
            $height = 500;

            // Set the storage path for the new image
            $publicPath = 'assets/images/post/';

            // Generate a unique filename for the new image
            $filename = "cover-".uniqid() . '.' . $image->getClientOriginalExtension();

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


        $save = New Post ();
        $save->cover = $url;
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
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        if ($request->hasFile('images')) {
            // Get the uploaded image file
            $image = $request->file('images');
    
            // Set the desired width and height
            $width = 1200;
            $height = 500;
    
            // Set the storage path for the new image
            $publicPath = 'assets/images/post/';
    
            // Generate a unique filename for the new image
            $filename = "cover-".uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Create a new instance of Intervention Image
            $image = Image::make($image);
    
            // Resize the image while maintaining aspect ratio
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path($publicPath . $filename));
            $url = asset($publicPath . $filename);
    
            // Delete the old image if it exists
            if ($save->cover && file_exists(public_path($save->cover))) {
                unlink(public_path($save->cover));
            }
    
            $save->cover = $url;
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

    public function kategori_project(){
        $data = ProjectCategory::get();
        return view('admin.kategori_project.data',compact('data')) ;
    }

    public function kategori_project_add(){
        return view('admin.kategori_project.add') ;
    }

    public function kategori_project_add_p(Request $request){
        
        // return $request->nama ;
        $request->validate([
            'nama' => 'required|string|max:255|unique:project_categories,category,NULL,id,deleted_at,NULL',
            'status' => 'required|in:Aktif,Tidak',
        ]);

        $save  = New ProjectCategory() ;
        $save->category = $request->nama;
        $save->status = $request->status;
        $save->save() ;

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function kategori_project_edit(Request $request){
        
        $d = ProjectCategory::where("id",$request->id)->firstOrFail();
        return view('admin.kategori_project.edit',compact('d')) ;
    }

    public function kategori_project_edit_p(Request $request){
        
        // return $request->nama ;
        
        $save  = ProjectCategory::where("id",$request->id)->firstOrFail() ;


        $request->validate([
            'nama' => 'required|string|max:255|unique:project_categories,category,' . $save->id . ',id,deleted_at,NULL',
            'status' => 'required|in:Aktif,Tidak',
        ]);

        $save->category = $request->nama;
        $save->status = $request->status;
        $save->save() ;

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategori_project_delete_p(Request $request){
        
        $save  = ProjectCategory::where("id",$request->id)->firstOrFail() ;
        $save->delete() ;

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function project(){
        $data = Project::get();
        return view('admin.project.data',compact('data')) ;
    }


    public function project_edit(Request $request){
        
        $project = Project::where("id",$request->id)->firstOrFail();
        $categories = ProjectCategory::all();
        return view('admin.project.edit',compact('project','categories')) ;
    }

    public function project_edit_p(Request $request)
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

        $project = Project::findOrFail($request->id);

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

            // Simpan data proyek
            $project->save();

            DB::commit();

            return back()->with('success', 'Proyek berhasil diperbarui.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui proyek.');
        }
    }


    public function iduka(){
        $data = Iduka::get();
        return view('admin.iduka.data', compact('data'));
    }


    public function iduka_edit(Request $request){
        
        $d = Iduka::with("user")->where("id",$request->id)->firstOrFail();
        return view('admin.iduka.edit',compact('d')) ;
    }

    public function iduka_edit_p(Request $request){
        
        $iduka = Iduka::findOrFail($request->id);
        $data = $request->validate([
            'id' => 'required|exists:idukas,id',
            'nama' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:Aktif,Tidak',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Add validation for image upload
            'email' => 'nullable|email|max:255|unique:users,email,' . $iduka->user_id,
            'password' => 'nullable|min:8|same:password_confirmation', // Validasi password harus sama dengan konfirmasi
            'password_confirmation' => 'nullable|min:8', // Konfirmasi password
        ]);

        try {
            DB::beginTransaction();

            $iduka = Iduka::findOrFail($data['id']);
            $iduka->name = $data['nama'];
            $iduka->address = $data['address'];
            $iduka->phone = $data['phone'];
            $iduka->status = $data['status'];

            if ($request->hasFile('photo')) {
                $new_photo = time() . '_' . Str::slug($request->file('photo')->getClientOriginalName());
                $request->file('photo')->move('images/iduka/', $new_photo);
                $iduka->photo = 'images/iduka/' . $new_photo;
            }

            $iduka->save();

            // Update associated user's email and password if provided
            $user = $iduka->user;
            $user->username = $request->input('nama');
            if (!empty($request->has('email'))) {
                $user->email = $request->input('email');
            }
            if (!empty($request->has('password'))) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }


    public function internship(){
        $data = Internship::get();
        return view('admin.internship.data', compact('data'));
    }


    public function internship_edit(Request $request){
        
        $d = Internship::with("user")->where("id",$request->id)->firstOrFail();
        return view('admin.internship.edit',compact('d')) ;
    }

    public function internship_edit_p(Request $request){
        
        $internship = Internship::findOrFail($request->id);
        $data = $request->validate([
            'id' => 'required|exists:internships,id',
            'nama' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:Aktif,Tidak',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Add validation for image upload
            'email' => 'nullable|email|max:255|unique:users,email,' . $internship->user_id,
            'password' => 'nullable|min:8|same:password_confirmation', // Validasi password harus sama dengan konfirmasi
            'password_confirmation' => 'nullable|min:8', // Konfirmasi password
        ]);

        try {
            DB::beginTransaction();

            $internship = Internship::findOrFail($data['id']);
            $internship->name = $data['nama'];
            $internship->address = $data['address'];
            $internship->phone = $data['phone'];
            $internship->status = $data['status'];

            if ($request->hasFile('photo')) {
                $new_photo = time() . '_' . Str::slug($request->file('photo')->getClientOriginalName());
                $request->file('photo')->move('images/internship/', $new_photo);
                $internship->photo = 'images/internship/' . $new_photo;
            }

            $internship->save();

            // Update associated user's email and password if provided
            $user = $internship->user;
            $user->username = $request->input('nama');
            if (!empty($request->has('email'))) {
                $user->email = $request->input('email');
            }
            if (!empty($request->has('password'))) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }


    public function event(){
        $data = Event::get();
        return view('admin.event.data', compact('data'));
    }

    public function event_add(Request $request){
        return view('admin.event.add') ;
    }

    public function event_add_p(Request $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        // return 1 ;

        try {
            // Validasi data input
            $validator = Validator::make($request->all(), [
                'images' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
                'status' => 'required|in:Aktif,Tidak',
                'judul_acara' => 'required|max:255',
                'deskripsi' => 'required',
                'jumlah_peserta' => 'required|integer',
                'periode_pendaftaran' => [
                    'required',
                    'regex:/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} - \d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
                    function ($attribute, $value, $fail) {
                        $dates = explode(' - ', $value);
                        $start_date = $dates[0];
                        $end_date = $dates[1];

                        // Validasi kustom untuk memeriksa periode pendaftaran dan periode acara
                        if (strtotime($end_date) <= strtotime($start_date)) {
                            $fail('Periode pendaftaran harus berakhir sebelum periode acara dimulai.');
                        }
                    },
                ],
                'periode_acara' => [
                    'required'
                ]
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $d1  = explode(" - ",$request->periode_pendaftaran);
            $d2  = explode(" - ",$request->periode_acara);

            $description = $request->deskripsi;

            if (!empty($description)) {
                $dom = new \DomDocument();
                @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $k => $img) {
                    $data = $img->getAttribute('src');

                    if ( !strstr( $data, 'event' ) ) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/assets/images/event/" . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                    }
                }
                $description = $dom->saveHTML();
            }

            if ($request->hasFile('images')) {
                // Get the uploaded image file
                $image = $request->file('images');
    
                // Set the desired width and height
                $width = 1200;
                $height = 500;
    
                // Set the storage path for the new image
                $publicPath = 'assets/images/event/';
    
                // Generate a unique filename for the new image
                $filename = "cover-".uniqid() . '.' . $image->getClientOriginalExtension();
    
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

            // Membuat instance Event dan mengisi data dari input form
            $event = new Event();
            $event->title = $request->input('judul_acara');
            $event->cover = $url;
            $event->status = $request->status;
            $event->description = $description;
            $event->participants = $request->jumlah_peserta;
            $event->start_date = $d2[0];
            $event->end_date = $d2[1];
            $event->reg_start = $d1[0];
            $event->reg_end = $d1[1];

            // Menyimpan data event ke dalam database
            $event->save();

            // Mengonfirmasi transaksi database
            DB::commit();

            // Mengarahkan pengguna kembali ke halaman sebelumnya (indeks event)
            return back()->with('success', 'Event berhasil dibuat!');
        } catch (\Exception $e) {
            dd($e);
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollback();

            // Handle kesalahan sesuai kebutuhan Anda
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function event_edit(Request $request){
        
        $event = Event::where("id",$request->id)->firstOrFail();
        return view('admin.event.edit',compact('event')) ;
    }

    
    public function event_edit_p(Request $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        // return 1 ;

        try {
            // Validasi data input
            $validator = Validator::make($request->all(), [
                'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:Aktif,Tidak',
                'judul_acara' => 'required|max:255',
                'deskripsi' => 'required',
                'jumlah_peserta' => 'required|integer',
                'periode_pendaftaran' => [
                    'required',
                    'regex:/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} - \d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
                    function ($attribute, $value, $fail) {
                        $dates = explode(' - ', $value);
                        $start_date = $dates[0];
                        $end_date = $dates[1];

                        // Validasi kustom untuk memeriksa periode pendaftaran dan periode acara
                        if (strtotime($end_date) <= strtotime($start_date)) {
                            $fail('Periode pendaftaran harus berakhir sebelum periode acara dimulai.');
                        }
                    },
                ],
                'periode_acara' => [
                    'required'
                ]
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $d1  = explode(" - ",$request->periode_pendaftaran);
            $d2  = explode(" - ",$request->periode_acara);

            $description = $request->deskripsi;

            if (!empty($description)) {
                $dom = new \DomDocument();
                @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $k => $img) {
                    $data = $img->getAttribute('src');

                    if ( !strstr( $data, 'event' ) ) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/assets/images/event/" . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                    }
                }
                $description = $dom->saveHTML();
            }

            if ($request->hasFile('images')) {
                // Get the uploaded image file
                $image = $request->file('images');
    
                // Set the desired width and height
                $width = 1200;
                $height = 500;
    
                // Set the storage path for the new image
                $publicPath = 'assets/images/event/';
    
                // Generate a unique filename for the new image
                $filename = "cover-".uniqid() . '.' . $image->getClientOriginalExtension();
    
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
                $url = $event->cover;
                $filename = null;
            }

            // Membuat instance Event dan mengisi data dari input form
            $event = Event::where("id",$request->id)->firstOrFail();
            $event->title = $request->input('judul_acara');
            $event->cover = $url;
            $event->status = $request->status;
            $event->description = $description;
            $event->participants = $request->jumlah_peserta;
            $event->start_date = $d2[0];
            $event->end_date = $d2[1];
            $event->reg_start = $d1[0];
            $event->reg_end = $d1[1];

            // Menyimpan data event ke dalam database
            $event->save();

            // Mengonfirmasi transaksi database
            DB::commit();

            // Mengarahkan pengguna kembali ke halaman sebelumnya (indeks event)
            return back()->with('success', 'Event berhasil diupdate!');
        } catch (\Exception $e) {
            dd($e);
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollback();

            // Handle kesalahan sesuai kebutuhan Anda
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function event_delete_p(Request $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        // return 1 ;

        try {
            // Validasi data input



            // Membuat instance Event dan mengisi data dari input form
            $event = Event::where("id",$request->id)->firstOrFail();

            // Menyimpan data event ke dalam database
            $event->delete();

            // Mengonfirmasi transaksi database
            DB::commit();

            // Mengarahkan pengguna kembali ke halaman sebelumnya (indeks event)
            return back()->with('success', 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            dd($e);
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollback();

            // Handle kesalahan sesuai kebutuhan Anda
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function event_peserta(Request $request){
        
        $event = Event::where("id",$request->id)->firstOrFail();
        return view('admin.event.peserta',compact('event')) ;
    }
    
}
