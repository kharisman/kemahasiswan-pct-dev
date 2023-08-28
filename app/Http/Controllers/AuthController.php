<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Iduka;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
	public function register()
	{
		return view('landingpage/register');
	}

	public function registerSimpan(Request $request)
	{
		DB::beginTransaction();
		try {
			$validator = Validator::make($request->all(), [
				'username' => 'required|string|min:3|max:225',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|confirmed'
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$user = User::create([
				'username' => $request->username,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'roles' => 'internship'
			]);

			$internship = new Internship();
			$internship->user_id = $user->id;
			$internship->name = $request->username;
			$internship->gender = "Pria";
			$internship->date_of_birth = "2022-02-02";
			$internship->address = "";
			$internship->phone = "";
			$internship->nationality = "";
			$internship->education = "";
			$internship->interest = "";
			$internship->photo = "";
			$internship->status = "Tidak";
			$internship->save();
			DB::commit();
			return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login');
		} catch (\Exception $e) {
			DB::rollback();
			return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
		}
	}

	public function registerIduka()
	{
		return view('landingpage/register_iduka');
	}

	
public function registerIdukaSimpan(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'iduka'
        ]);

        $iduka = new Iduka();
        $iduka->user_id = $user->id;
        $iduka->name = $request->username;
        $iduka->address = null;
        $iduka->phone = null;
        $iduka->photo = null;
        $iduka->status = "Tidak";
        $iduka->save();

        DB::commit();

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
    }
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
		} else if ($user->hasRole('internship')) {
			return redirect()->route('internship.index');
		} else if ($user->hasRole('admin')) {
			return redirect()->route('admin.dashboard');
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
