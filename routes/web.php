<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdukaController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\LandingController;

Route::get('', [LandingController::class, 'index'])->name('index');
Route::get('/pengajuan-iduka', [LandingController::class, 'iduka'])->name('iduka');
Route::get('/pengajuan-intership', [LandingController::class, 'intership'])->name('intership');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');

Route::get('internship-index', [InternshipController::class, 'dashboardInternship'])->name('internship.index');
Route::get('internship-project', [InternshipController::class, 'projectInternship']);
Route::get('internship-history', [InternshipController::class, 'historyInternship']);
Route::get('internship-data', [InternshipController::class, 'dataInternship']);
Route::post('internship-data', [InternshipController::class, 'dataInternshipPost']);
Route::get('iduka/index', [IdukaController::class, 'dashboard_iduka'])->name('iduka.index');

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');
	Route::get('registerIduka', 'registerIduka')->name('registerIduka');
	Route::post('registerIduka', 'registerIdukaSimpan')->name('registerIduka.simpan');
	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('iduka/recruitment', [ProjectController::class, 'create_project'])->name('create_project');
Route::post('save_project', [ProjectController::class, 'saveProject'])->name('save_project');



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
Route::post('/add-category-project',[adminController::class,'addCategoryProject']);
Route::post('/add-category-project',[adminController::class,'addCategoryProjectPost']);

