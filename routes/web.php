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


Route::middleware(['auth'])->group(function () {
	Route::get('/admin-dashboard',[adminController::class,'adminDashboard'])->name("admin.dashboard");	
	Route::prefix('admin')->group(function () {
		Route::get('settings/slider',[adminController::class,'slider']);
		Route::get('settings/slider/add',[adminController::class,'slider_add']);
		Route::post('settings/slider/add',[adminController::class,'slider_add_p']);
		Route::get('settings/slider/edit',[adminController::class,'slider_edit']);
		Route::post('settings/slider/edit',[adminController::class,'slider_edit_p']);
		Route::get('settings/slider/delete',[adminController::class,'slider_delete_p']) ;


		
		Route::get('settings/kategori-berita',[adminController::class,'kategori_berita']);
		Route::get('settings/kategori-berita/add',[adminController::class,'kategori_berita_add']);
		Route::post('settings/kategori-berita/add',[adminController::class,'kategori_berita_add_p']);
		Route::get('settings/kategori-berita/edit',[adminController::class,'kategori_berita_edit']);
		Route::post('settings/kategori-berita/edit',[adminController::class,'kategori_berita_edit_p']);
		Route::get('settings/kategori-berita/delete',[adminController::class,'kategori_berita_delete_p']) ;
	});
});

Route::get('/admin-artikel',[adminController::class,'adminArtikel']);
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
Route::get('/add-category-project',[adminController::class,'addCategoryProject']);
Route::post('/add-category-project',[adminController::class,'addCategoryProjectPost']);

