<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function dashboardInternship()
	{
		return view('internship/index');
	}
}
