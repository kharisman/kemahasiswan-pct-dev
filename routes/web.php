<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


//Tes admin blade
Route::get('/admin-dashboard', function () { return view('admin/dashboard');});
Route::get('/admin-artikel', function () { return view('admin/artikel');});
Route::get('/admin-confirm-iduka', function () { return view('admin/confirm_iduka');});
Route::get('/admin-confirm-internship', function () { return view('admin/confirm_internship');});
Route::get('/admin-event', function () { return view('admin/event');});
Route::get('/admin-iduka', function () { return view('admin/iduka');});
Route::get('/admin-internship', function () { return view('admin/internship');});