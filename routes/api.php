<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Anak_asuhController;
use App\Http\Controllers\Api\DonaturController;
use App\Http\Controllers\Api\Kategori_kegiatanController;
use App\Http\Controllers\Api\DonasiController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ini untuk route bagian anak asuh
Route::get('/anak_asuh', [Anak_asuhController::class, 'index']);
Route::get('/anak_asuh/{id}', [Anak_asuhController::class, 'show']);
Route::post('/anak_asuh-create', [Anak_asuhController::class, 'store']);
Route::put('/anak_asuh/{id}', [Anak_asuhController::class, 'update']);
Route::delete('/anak_asuh/{id}', [Anak_asuhController::class, 'destroy']);

//ini untuk route bagian donatur
Route::get('/donatur', [DonaturController::class, 'index']);
Route::get('/donatur/{id}', [DonaturController::class, 'show']);
Route::post('/donatur-create', [DonaturController::class, 'store']);
Route::put('/donatur-update/{id}', [DonaturController::class, 'update']);
Route::delete('/donatur-destroy/{id}', [DonaturController::class, 'destroy']);

//ini untuk bagian donasi
Route::get('/donasi', [DonasiController::class, 'index']);
Route::get('/donasi/{id}', [DonasiController::class, 'show']);
Route::post('/donasi-create', [DonasiController::class, 'store']);
Route::put('/donasi-update/{id}', [DonasiController::class, 'update']);
Route::delete('/donasi-destroy/{id}', [DonasiController::class, 'destroy']);

Route::apiResource('/anak_asuh', Anak_asuhController::class);
Route::apiResource('/donatur', DonaturController::class);
Route::apiResource('/kategori_kegiatan', Kategori_kegiatanController::class);
Route::apiResource('/donasi', DonasiController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
