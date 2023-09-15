<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Slider;
use App\Models\Post;
use App\Models\Iduka;
use App\Models\Internship;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectCategory;
use App\Models\PostCategory;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    //
    public function index()
	{
		$Sliders = Slider::where("status","Aktif")->OrderBy("sort","ASC")->get();
        $new_posts = Post::with("categories.category")->where("status","Aktif")->OrderBy("created_at","DESC")->get();
        $pop_posts = Post::with("categories.category")->where("status","Aktif")->OrderBy("views","DESC")->get();
		$projects = Project::where("status","Aktif")->with("iduka")->get();

		// return $new_posts ;
		return view('beranda',compact('Sliders','new_posts','pop_posts','projects'));
	}

    public function iduka()
	{
		return view('iduka');
	}

    public function intership()
	{
		return view('intership');
	}
    
    public function kontak()
	{
		return view('kontak');
	}

	public function berita_detail(Request $request, $id, $judul)
	{
		
        $post = Post::with("categories.category")->where("status","Aktif")->where("id",$id)->firstOrFail();

		
		$ip = request()->ip();
		$userAgent = request()->header('User-Agent'); // Mendapatkan informasi User-Agent

		// Generate a unique cache key based on IP and User-Agent
		$cacheKey = md5($ip . $userAgent);

		// Check if the cache key exists
		if (!Cache::has($cacheKey)) {
			// Increment the views counter
			$post->increment('views');

			// Cache the cache key to prevent further increment
			Cache::put($cacheKey, true, now()->addDay());
		}

    	return view('berita_detail', compact("post"));
	}


	public function berita(Request $request)
	{
		$query = Post::with("categories.category")->where("status", "Aktif");

		// Filter berdasarkan judul dan konten
		if ($request->has('search')) {
			$search = $request->search;
			// dd($search);
			$query->where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%');
			
		}

		// Filter pilihan: terbaru atau populer
		if ($request->has('filter')) {
			if ($request->input('filter') === 'terbaru') {
				$query->orderBy('created_at', 'DESC');
			} elseif ($request->input('filter') === 'populer') {
				$query->orderBy('views', 'DESC');
			}
		}

		// Filter berdasarkan kategori
		if ($request->has('kategori')) {
			$kategoriId = $request->input('kategori');
			$query->whereHas('categories', function ($q) use ($kategoriId) {
				$q->where('category_id', $kategoriId);
			});
		}

		$posts = $query->get();

		$categories = Category::all(); // Mendapatkan daftar kategori
		$filter = $request->get('filter'); 

		return view('berita', compact('posts','categories','filter'));
	}

	public function project_detail(Request $request, $id, $judul)
	{
		
        $project = Project::with("iduka")->where("status","Aktif")->where("id",$id)->firstOrFail();

		
		$ip = request()->ip();
		$userAgent = request()->header('User-Agent'); // Mendapatkan informasi User-Agent

		// Generate a unique cache key based on IP and User-Agent
		$cacheKey = md5($ip . $userAgent)."p".$project->id;

		// Check if the cache key exists
		if (!Cache::has($cacheKey)) {
			// Increment the views counter
			$project->increment('views');

			// Cache the cache key to prevent further increment
			Cache::put($cacheKey, true, now()->addDay());
		}

    	return view('project_detail', compact("project"));
	}

	public function project(Request $request)
	{
		$query = Project::with("iduka")->with("category")->where("status","Aktif");

		// Filter berdasarkan judul dan konten
		if ($request->has('search')) {
			$search = $request->search;
			// dd($search);
			$query->where('name', 'like', '%' . $search . '%')->orWhere('notes', 'like', '%' . $search . '%');
			
		}

		// Filter pilihan: terbaru atau populer
		if ($request->has('filter')) {
			if ($request->input('filter') === 'terbaru') {
				$query->orderBy('created_at', 'DESC');
			} elseif ($request->input('filter') === 'populer') {
				$query->orderBy('views', 'DESC');
			}
		}

		// Filter berdasarkan kategori
		if ($request->has('kategori')) {
			$kategoriId = $request->input('kategori');
				$query->where('category_id', $kategoriId);
			
		}

		$posts = $query->get();

		$categories = ProjectCategory::all(); // Mendapatkan daftar kategori
		$filter = $request->get('filter'); 

		return view('project', compact('posts','categories','filter'));
	}

	public function event_detail(Request $request, $id, $judul)
	{
		
        $project = Event::where("id",$id)->firstOrFail();

		
		$ip = request()->ip();
		$userAgent = request()->header('User-Agent'); // Mendapatkan informasi User-Agent

		// Generate a unique cache key based on IP and User-Agent
		$cacheKey = md5($ip . $userAgent)."e".$project->id;

		// Check if the cache key exists
		if (!Cache::has($cacheKey)) {
			// Increment the views counter
			$project->increment('views');

			// Cache the cache key to prevent further increment
			Cache::put($cacheKey, true, now()->addDay());
		}

    	return view('event_detail', compact("project"));
	}

	public function event_p(Request $request, $id, $judul)
	{
		// Validasi input
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:event_registrations,email,NULL,id,event_id,' . $id,
			'phone' => 'required|string|max:20|unique:event_registrations,phone,NULL,id,event_id,' . $id,
			'activity' => 'required|string|max:255',
		]);

		// Dapatkan ID pengguna yang sedang masuk
		$user = Auth::user()->id;

		// Gunakan transaksi database untuk memastikan konsistensi
		DB::beginTransaction();

		try {
			// Simpan data pendaftaran ke dalam tabel event_registrations
			$save = new EventRegistration();
			$save->event_id = $id;
			$save->user_id = (int)$user;
			$save->name = $request->name;
			$save->email = $request->email;
			$save->phone = $request->phone;
			$save->activity = $request->activity;
			$save->save();

			// Commit transaksi ke database
			DB::commit();

			// Redirect atau berikan respons sukses
			return redirect()->back()->with('success', 'Pendaftaran berhasil!');
		} catch (\Exception $e) {
			// Jika ada kesalahan, rollback transaksi dan berikan respons kesalahan
			DB::rollback();
			return redirect()->back()->with('error', 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.');
		}
	}

	public function event(Request $request)
	{
		$query = Event::where("status","Aktif")->orderBy("id","DESC");

		// Filter berdasarkan judul dan konten
		if ($request->has('search')) {
			$search = $request->search;
			// dd($search);
			$query->where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
			
		}

		// Filter pilihan: terbaru atau populer
		if ($request->has('filter')) {
			if ($request->input('filter') === 'terbaru') {
				$query->orderBy('created_at', 'DESC');
			} elseif ($request->input('filter') === 'populer') {
				$query->orderBy('views', 'DESC');
			}
		}

		

		$posts = $query->get();

		$filter = $request->get('filter'); 

		return view('event', compact('posts','filter'));
	}

}
