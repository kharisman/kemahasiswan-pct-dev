<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|   
*/

Route::prefix('/v1')->group(function () {
    
    Route::post('/login', [App\Http\Controllers\AuthController::class,'login2']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/user', [App\Http\Controllers\AuthController::class,'user']);
        Route::get('/kuis', [App\Http\Controllers\SoalController::class,'kuis']);
        Route::post('/kuis/add', [App\Http\Controllers\SoalController::class,'kuis_add']);
        Route::get('/kuis/{id}', [App\Http\Controllers\SoalController::class,'kuis_detail']);
        Route::post('/kuis/edit', [App\Http\Controllers\SoalController::class,'kuis_edit']);
        Route::post('/kuis/delete', [App\Http\Controllers\SoalController::class,'kuis_delete']);    
        Route::get('/kategori', [App\Http\Controllers\SoalController::class,'kategori']);
        Route::post('/kategori/add', [App\Http\Controllers\SoalController::class,'kategori_add']);
        Route::post('/kategori/edit', [App\Http\Controllers\SoalController::class,'kategori_edit']);
    });

    
    Route::post('/pct-kuis', [App\Http\Controllers\SoalController::class,'pct_kuis']);
    Route::post('/pct-kuis-submit', [App\Http\Controllers\SoalController::class,'pct_kuis_submit']);



});
