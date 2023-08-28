<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index()
	{
		return view('beranda');
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
}
