<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Iduka;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

	function login2(Request $request) {

        $v = Validator::make($request->all(), [
            'credential' => 'required',
            'kata_sandi'  => 'required|min:3',	
            'tipe'  => 'required|in:admin,client',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);

        }

        $user = User::where("email",$request->credential)->first();

        if(!$user){

            if(!$user){
                return response()->json([
                    'status' => 'error',
                    'errors' => ["credential"=>["Credential tidak terdaftar."]]
                ], 422);

            }
		}

        if(!Hash::check($request->kata_sandi,$user->password)){
            return response()->json([
                'status' => 'error',
                'errors' => ["kata_sandi"=>["kata sandi salah."]]
            ], 422);
		}

        $token = $user->createToken('kolaborasi-token-'.$user->uid.'-'.date('Ymd').'-'.time())->plainTextToken;

        if (!$token){
            return response()->json([
                'status' => 'error',
                'errors' => ["message"=>["Token tidak valid."]]
            ], 422);
        }

        return response()->json(['status' => 'success', 'data' => ['token' => $token]], 200)->header('Authorization', $token);

    }

	public function user(Request $request)
    {
        $m = User::where("id", Auth::user()->id)->first();


        return response()->json([
            'status' => 'success',
            'data' => $m
        ], 200);
    }

	public function register()
	{
		if (Auth::check()) {
			// Jika pengguna sudah login, maka redirect sesuai peran (role) mereka.
			if (Auth::user()->hasRole('iduka')) {
				return redirect()->route('iduka.index');
			} elseif (Auth::user()->hasRole('internship')) {
				if (!empty(session()->get('last_url'))) {
					return redirect(session()->get('last_url'));
				}
				return redirect()->route('internship.index');
			} elseif (Auth::user()->hasRole('admin')) {
				return redirect()->route('admin.dashboard');
			}
		}
		return view('landingpage/register');
	}

	public function registerSimpan(Request $request)
	{
		DB::beginTransaction();
		try {
			$validator = Validator::make($request->all(), [
				'username' => 'required|string|min:3|max:225',
				'email' => 'required|email|unique:users,email',
				'password' => [
					'required',
					'confirmed',
					'min:8', // Minimal 8 karakter
					'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/' // Kombinasi huruf, angka, dan simbol
				]
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
			$internship->gender = null;
			$internship->date_of_birth =null ;
			$internship->address = "";
			$internship->phone = "";
			$internship->nationality = "";
			$internship->education = "";
			$internship->interest = "";
			$internship->photo = "";
			$internship->status = "Aktif";
			$internship->updated_at = null;
			$internship->save();
			DB::commit();
			return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login');
		} catch (\Exception $e) {
			dd($e) ;
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
			$blockedEmailDomains = ['gmail.com', 'yahoo.com']; // Daftar domain yang dilarang
	
			$emailParts = explode('@', $request->email);
			$emailDomain = end($emailParts);
	
			// Cek apakah alamat email berasal dari domain yang dilarang
			if (in_array($emailDomain, $blockedEmailDomains)) {
				return redirect()->back()->with('error', 'Akun Industri hanya dapat didaftarkan dengan domain resmi usaha, seperti palcomtech.ac.id Jika Anda tidak memiliki email domain resmi usaha, anda akan dialihkan ke Google form khusus untuk mendaftar, dan mohon menunggu tim Palcomtech memverifikasi data terlebih dahulu.');

			}
	
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
	
			return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silakan login');
		} catch (\Exception $e) {
			DB::rollback();
			return back()->with('error', 'Terjadi kesalahan saat melakukan registrasi.');
		}
	}
	


	public function login(Request $request)
	{
		if (Auth::check()) {
			// Jika pengguna sudah login, maka redirect sesuai peran (role) mereka.
			if (Auth::user()->hasRole('iduka')) {
				return redirect()->route('iduka.index');
			} elseif (Auth::user()->hasRole('internship')) {
				if (!empty(session()->get('last_url'))) {
					return redirect(session()->get('last_url'));
				}
				return redirect()->route('internship.index');
			} elseif (Auth::user()->hasRole('admin')) {
				return redirect()->route('admin.dashboard');
			}
		}

		// Jika pengguna belum login, tampilkan halaman login.
		$lastUrl = $request->id;
		if (!empty($lastUrl)) {
			$lastUrl = url('internship-project-apply/' . $lastUrl);
		}
		session()->put('last_url', $lastUrl);
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
			// dd(session()->get('last_url'));
			if (!empty(session()->get('last_url'))){
				return redirect(session()->get('last_url'));
			}
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
