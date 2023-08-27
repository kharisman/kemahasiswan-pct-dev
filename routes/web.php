<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthIdukaController;
use App\Http\Controllers\IdukaController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\adminController;

Route::view('/', 'index')->name('index');
Route::get('internship/index', [InternshipController::class, 'dashboardInternship'])->name('internship.index');
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

Route::get('/admin-dashboard',[adminController::class,'adminDashboard']);
Route::get('/admin-artikel',[adminController::class,'adminArtikel']);
Route::get('/admin-confirm-iduka',[adminController::class,'adminConfirmIduka']);
Route::get('/admin-confirm-internship',[adminController::class,'adminConfirmInternship']);
Route::get('/admin-event',[adminController::class,'adminEvent']);
Route::get('/admin-iduka',[adminController::class,'adminIduka']);
Route::get('/admin-internship',[adminController::class,'adminInternship']);

Route::get('/add-slider',[adminController::class,'addSlider']);
Route::post('/add-slider',[adminController::class,'addSliderPost']);
Route::get('/add-category',[adminController::class,'addCategory']);
Route::post('/add-category',[adminController::class,'addCategoryPost']);
Route::get('/add-post',[adminController::class,'addPost']);
Route::post('/add-post',[adminController::class,'addPostPost']);

