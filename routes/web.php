<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthIdukaController;
use App\Http\Controllers\IdukaController;
use App\Http\Controllers\InternshipController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


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

Route::controller(AuthIdukaController::class)->group(function () {
	Route::get('registerIduka', 'registerIduka')->name('registerIduka');
	Route::post('registerIduka', 'registerIdukaSimpan')->name('registerIduka.simpan');
	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
	
});