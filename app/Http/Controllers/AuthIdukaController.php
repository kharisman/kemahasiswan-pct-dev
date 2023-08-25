<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthIdukaController extends Controller
{
	public function registerIduka()
	{
		return view('landingpage/register_iduka');
	}

	public function registerIdukaSimpan(Request $request)
	{
		$validator=Validator::make($request->all(), [
			'username' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed'
		]);
		if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		User::create([
			'username' => $request->username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'roles' => 'iduka'
		]);
		return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
	}

	public function login()
	{
		return view('landingpage/login');
	}

	public function loginAksi(Request $request)
	{
		Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		])->validate();

		if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email' => trans('auth.failed')
			]);
		}

		$user = Auth::user();

		if ($user->hasRole('iduka')) {
			return redirect()->route('iduka.index');
		} elseif ($user->hasRole('internship')) {
			return redirect()->route('internship.index');
		}

		// Handle other roles or scenarios

		$request->session()->regenerate();
	}

	public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/');
	}

	
}
