<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthIdukaController;
use App\Http\Controllers\IdukaController;
use App\Http\Controllers\InternshipController;

Route::view('/', 'index')->name('index');
Route::get('internship/index', [InternshipController::class, 'dashboard_internship'])->name('internship.index');
Route::get('iduka/index', [IdukaController::class, 'dashboard_iduka'])->name('iduka.index');

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');
	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
	
});
//Tes admin blade
Route::get('/admin-dashboard', function () { return view('admin/dashboard');});
Route::get('/admin-artikel', function () { return view('admin/artikel');});
Route::get('/admin-confirm-iduka', function () { return view('admin/confirm_iduka');});
Route::get('/admin-confirm-internship', function () { return view('admin/confirm_internship');});
Route::get('/admin-event', function () { return view('admin/event');});
Route::get('/admin-iduka', function () { return view('admin/iduka');});
Route::get('/admin-internship', function () { return view('admin/internship');});
