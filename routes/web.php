<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdukaController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\LandingController;


Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');
	Route::get('registerIduka', 'registerIduka')->name('registerIduka');
	Route::post('registerIduka', 'registerIdukaSimpan')->name('registerIduka.simpan');
	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('', [LandingController::class, 'index'])->name('index');
Route::get('/pengajuan-iduka', [LandingController::class, 'iduka'])->name('iduka');
Route::get('/pengajuan-intership', [LandingController::class, 'intership'])->name('intership');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');


Route::get('/berita', [LandingController::class, 'berita'])->name('berita');
Route::get('/berita/{id}/{judul}', [LandingController::class, 'berita_detail']);

Route::get('internship-index', [InternshipController::class, 'dashboardInternship'])->name('internship.index');
Route::get('internship-project', [InternshipController::class, 'projectInternship']);
Route::post('internship-project', [InternshipController::class, 'projectInternshipPost']);
Route::get('internship-history', [InternshipController::class, 'historyInternship']);
Route::get('internship-data', [InternshipController::class, 'dataInternship']);
Route::post('internship-data', [InternshipController::class, 'dataInternshipPost']);
Route::get('internship-detail-project/{id}', [InternshipController::class, 'projectDetailInternship']);
Route::get('internship-project-apply/{id}', [InternshipController::class, 'applyProjectInternship']);

Route::middleware(['auth'])->group(function () {
Route::get('iduka/index', [IdukaController::class, 'dashboard_iduka'])->name('iduka.index');
Route::get('/iduka/{id}/edit', [IdukaController::class, 'edit'])->name('iduka.edit');
Route::put('/iduka/{id}/update', [IdukaController::class, 'update'])->name('iduka.update');
Route::get('/iduka/profile', [IdukaController::class, 'profile'])->name('iduka.profile');
Route::get('/iduka/change_email_password', [IdukaController::class, 'change_email_password'])->name('iduka.change_email_password');
Route::post('idukaa/profile/update-email', [IdukaController::class, 'updateEmail'])->name('profile.update.email');
Route::post('iduka/profile/update-password', [IdukaController::class, 'updatePassword'])->name('profile.update.password');

Route::get('iduka/project', [ProjectController::class, 'all_project'])->name('iduka.all_project');
Route::get('iduka/pending_project', [ProjectController::class, 'pending_project'])->name('iduka.pending_project');
Route::get('iduka/aktif_project', [ProjectController::class, 'aktif_project'])->name('iduka.aktif_project');
Route::get('iduka/selesai_project', [ProjectController::class, 'selesai_project'])->name('iduka.selesai_project');
Route::get('iduka/recruitment', [ProjectController::class, 'create_project'])->name('create_project');
Route::post('save_project', [ProjectController::class, 'saveProject'])->name('save_project');
Route::get('/iduka/{id}/edit_status', [ProjectController::class, 'editStatus'])->name('edit_status');
Route::post('/iduka/{id}/update-status', [ProjectController::class, 'updateStatus'])->name('update_status');
Route::get('/iduka/edit-project/{id}', [ProjectController::class, 'editProject'])->name('edit_project');
Route::put('/iduka/update-project/{id}', [ProjectController::class, 'updateProject'])->name('update_project');
Route::delete('/projects/{id}', [IdukaController::class, 'delete'])->name('delete_project');
Route::delete('/projects/{id}', [ProjectController::class, 'delete'])->name('delete_project');
Route::get('iduka/pelamar', [ProjectController::class, 'data_apply'])->name('iduka.data_apply');
Route::get('iduka/status_diterima', [ProjectController::class, 'data_apply_diterima'])->name('iduka.data_apply_diterima');
Route::get('iduka/status_ditolak', [ProjectController::class, 'data_apply_ditolak'])->name('iduka.data_apply_ditolak');
Route::get('iduka/detail_pelamar/{projectApplyId}', [ProjectController::class, 'detail_apply'])->name('iduka.detail_apply');
Route::post('/edit-status/{applyId}', [ProjectController::class, 'edit_status_apply'])->name('edit.status');
Route::get('/ongoing_progress', [ProjectController::class, 'ongoing_progress'])->name('iduka.ongoing_progress');


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

		Route::get('settings/berita',[adminController::class,'berita']);
		Route::get('settings/berita/add',[adminController::class,'berita_add']);
		Route::post('settings/berita/add',[adminController::class,'berita_add_p']);
		Route::get('settings/berita/edit',[adminController::class,'berita_edit']);
		Route::post('settings/berita/edit',[adminController::class,'berita_edit_p']);
		Route::get('settings/berita/delete',[adminController::class,'berita_delete_p']) ;


		
		Route::get('settings/kategori-project',[adminController::class,'kategori_project']);
		Route::get('settings/kategori-project/add',[adminController::class,'kategori_project_add']);
		Route::post('settings/kategori-project/add',[adminController::class,'kategori_project_add_p']);
		Route::get('settings/kategori-project/edit',[adminController::class,'kategori_project_edit']);
		Route::post('settings/kategori-project/edit',[adminController::class,'kategori_project_edit_p']);
		Route::get('settings/kategori-project/delete',[adminController::class,'kategori_project_delete_p']) ;

		Route::get('project',[adminController::class,'project']);
		Route::get('project/edit',[adminController::class,'project_edit']);
		Route::post('project/edit',[adminController::class,'project_edit_p']);
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

