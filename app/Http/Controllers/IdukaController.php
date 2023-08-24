<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdukaController extends Controller
{
    public function dashboard_iduka()
	{
		return view('iduka/index');
	}

}
