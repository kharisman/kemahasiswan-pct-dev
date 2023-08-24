<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function dashboard_internship()
	{
		return view('internship/index');
	}
}
