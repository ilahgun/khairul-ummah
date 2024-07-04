<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Anak_asuhController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Metode_pembayaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Kategori_KegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Data_anakController;
use App\Http\Controllers\Data_strukturController;
use App\Http\Controllers\DonetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage.home');
});

Route::get('/home', function () {
    return view('landingpage.home');
});

Route::get('/administrator', function () {
    return view('admin.home');
})->middleware('auth');

Route::get('/contact', function () {
    return view('landingpage.contact');
});

Route::get('/about', function () {
    return view('landingpage.about');
});

Route::get('/data_struktur', function () {
    return view('data_struktur.index');
});

Route::get('/data_anak', function () {
    return view('data_anak.index');
});

// Route::get('/Donasi', function () {
//     return view('landingpage.donasi');
// });

// Route::resource('Donasi', DonetController::class);

Route::resource('user', UserController::class)->middleware('peran:admin');
Route::resource('anak_asuh', Anak_asuhController::class)->middleware('auth');
Route::resource('donatur', DonaturController::class)->middleware('auth');
Route::resource('donasi', DonasiController::class)->middleware('auth');
Route::resource('metode_pembayaran', Metode_pembayaranController::class)->middleware('auth');
Route::resource('kategori_kegiatan', Kategori_KegiatanController::class)->middleware('auth');
Route::resource('kegiatan', KegiatanController::class)->middleware('auth');

Route::put('profile/{id}/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
Route::resource('profile', ProfileController::class)->middleware('auth');

Route::resource('data_anak', Data_anakController::class);
Route::resource('data_struktur', Data_strukturController::class);
Route::resource('donet', DonetController::class);


Route::get('dashboardcount', [DashboardController::class, 'index']);

//bagian anak_asuh
Route::get('anak_asuh-edit/{id}', [Anak_asuhController::class, 'edit'])->middleware('auth');
Route::get('anak_asuh-pdf', [Anak_asuhController::class, 'anak_asuhPDF'])->middleware('auth');
Route::get('anak_asuh-excel', [Anak_asuhController::class, 'anak_asuhExcel'])->middleware('auth');

//bagian donatur
Route::get('donatur-pdf', [DonaturController::class, 'donaturPDF'])->middleware('auth');
Route::get('donatur-excel', [DonaturController::class, 'donaturExcel'])->middleware('auth');
Route::get('donatur-edit/{id}', [DonaturController::class, 'edit'])->middleware('auth');

//bagian donasi
Route::get('donasi-pdf', [DonasiController::class, 'donasiPDF'])->middleware('auth');
Route::get('donasi-excel', [DonasiController::class, 'donasiExcel'])->middleware('auth');
Route::get('donasi-edit/{id}', [DonasiController::class, 'edit'])->middleware('auth');

//bagian metode pembayaran
Route::get('metode_pembayaran-pdf', [Metode_pembayaranController::class, 'metode_pembayaranPDF'])->middleware('auth');
Route::get('metode_pembayaran-excel', [Metode_pembayaranController::class, 'metode_pembayaranExcel'])->middleware('auth');
Route::get('metode_pembayaran-edit/{id}', [Metode_pembayaranController::class, 'edit'])->middleware('auth');

//bagian user
Route::get('user-pdf', [UserController::class, 'userPDF'])->middleware('auth');
Route::get('user-excel', [UserController::class, 'userExcel'])->middleware('auth');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');


//bagian kategori kegiatan
Route::get('kategori_kegiatan-pdf', [Kategori_KegiatanController::class, 'kategori_kegiatanPDF'])->middleware('auth');
Route::get('kategori_kegiatan-excel', [Kategori_KegiatanController::class, 'kategori_kegiatanExcel'])->middleware('auth');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->middleware('auth');

//bagian kategori kegiatan
Route::get('kegiatan-pdf', [KegiatanController::class, 'kegiatanPDF'])->middleware('auth');
Route::get('kegiatan-excel', [KegiatanController::class, 'kegiatanExcel'])->middleware('auth');
Route::get('kegiatan-edit/{id}', [KegiatanController::class, 'edit'])->middleware('auth');

Auth::routes();

Route::get('/homed', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('tags', App\Http\Controllers\TagController::class);

//route Posts
Route::get('posts/trash', [App\Http\Controllers\PostController::class, 'trash'])->name('posts.trash');
Route::post('posts/trash/{id}/restore', [App\Http\Controllers\PostController::class, 'restore'])->name('posts.restore');
Route::delete('posts/{id}/delete-permanent', [App\Http\Controllers\PostController::class, 'deletePermanent'])->name('posts.deletePermanent');
Route::resource('posts', App\Http\Controllers\PostController::class);


Route::get('/kegiatanld', [App\Http\Controllers\FrontController::class, 'index'])->name('homepage');
Route::get('post/{slug}', [App\Http\Controllers\FrontController::class, 'show'])->name('show');
Route::get('category/{category:slug}', [App\Http\Controllers\FrontController::class, 'category'])->name('category');
Route::get('tag/{tag:slug}', [App\Http\Controllers\FrontController::class, 'tag'])->name('tag');

Route::get('/list', [App\Http\Controllers\FrontController::class, 'list'])->name('list');

//ini route untuk menu search
Route::get('donatur-cari', [DonaturController::class, 'cari'])->middleware('auth');
Route::get('kategori_kegiatan-cari', [Kategori_KegiatanController::class, 'cari'])->middleware('auth');
Route::get('kegiatan-cari', [KegiatanController::class, 'cari'])->middleware('auth');
Route::get('user-cari', [UserController::class, 'cari'])->middleware('auth');
Route::get('anak_asuh-cari', [Anak_asuhController::class, 'cari'])->middleware('auth');
Route::get('donasi-cari', [DonasiController::class, 'cari'])->middleware('auth');

Auth::routes();

Route::get('/homed', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----API----
Route::get('/api-anak_asuh', [Anak_asuhController::class, 'apiAnak_asuh']);
Route::get('/api-anak_asuh/{id}', [Anak_asuhController::class, 'apiAnak_asuhDetail']);
