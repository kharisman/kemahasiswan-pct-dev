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

}
