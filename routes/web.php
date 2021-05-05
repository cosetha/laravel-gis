<?php

use Illuminate\Support\Facades\Route;
use App\Models\Lokasi;
use App\Models\Berita;

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
    $lokasi = Lokasi::inRandomOrder()->limit(2)->get();
    $berita = Berita::where('headline','on')->get();
    // print_r($berita);
    return view('home',['lokasi' => $lokasi,'berita' => $berita ]);
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/user/home', [App\Http\Controllers\UserController::class, 'index'])->name('user');

Route::namespace('Settings')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/settings/ssh/create', 'SSHController@create')->middleware('password.confirm');
    });

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload-img', [App\Http\Controllers\FileController::class, 'storeImg']);
Route::post('/upload-file', [App\Http\Controllers\FileController::class, 'store']);
Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        // Route::get('/settings/ssh/create', 'SSHController@create')->middleware('password.confirm');
        Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index']);

        Route::get('/lokasi', [App\Http\Controllers\LokasiController::class, 'index']);
        Route::get('/lokasi/create', [App\Http\Controllers\LokasiController::class, 'create']);
        Route::post('/lokasi/update', [App\Http\Controllers\LokasiController::class, 'update']);
        Route::get('/lokasi/edit/{id}', [App\Http\Controllers\LokasiController::class, 'edit']);
        Route::get('/lokasi/delete/{id}', [App\Http\Controllers\LokasiController::class, 'destroy']);
        Route::post('/lokasi/store', [App\Http\Controllers\LokasiController::class, 'store']);

        Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index']);
        Route::get('/kategori/create', [App\Http\Controllers\KategoriController::class, 'create']);
        Route::post('/kategori/update', [App\Http\Controllers\KategoriController::class, 'update']);
        Route::get('/kategori/edit/{id}', [App\Http\Controllers\KategoriController::class, 'edit']);
        Route::get('/kategori/delete/{id}', [App\Http\Controllers\KategoriController::class, 'destroy']);
        Route::post('/kategori/store', [App\Http\Controllers\KategoriController::class, 'store']);

        Route::get('/galeri', [App\Http\Controllers\GaleriController::class, 'index']);
        Route::get('/galeri/create', [App\Http\Controllers\GaleriController::class, 'create']);
        Route::post('/galeri/update', [App\Http\Controllers\GaleriController::class, 'update']);
        Route::get('/galeri/edit/{id}', [App\Http\Controllers\GaleriController::class, 'edit']);
        Route::get('/galeri/delete/{id}', [App\Http\Controllers\GaleriController::class, 'destroy']);
        Route::post('/galeri/store', [App\Http\Controllers\GaleriController::class, 'store']);

        Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index']);
        Route::get('/berita/create', [App\Http\Controllers\BeritaController::class, 'create']);
        Route::post('/berita/update', [App\Http\Controllers\BeritaController::class, 'update']);
        Route::get('/berita/edit/{id}', [App\Http\Controllers\BeritaController::class, 'edit']);
        Route::get('/berita/delete/{id}', [App\Http\Controllers\BeritaController::class, 'destroy']);
        Route::post('/berita/store', [App\Http\Controllers\BeritaController::class, 'store']);


        
    });

    Route::prefix('load')
    ->group(function () {
        // Route::get('/settings/ssh/create', 'SSHController@create')->middleware('password.confirm');
        Route::get('/table-lokasi', [App\Http\Controllers\LokasiController::class, 'LoadTableLokasi']);
        Route::get('/data-lokasi', [App\Http\Controllers\LokasiController::class, 'LoadDataLokasi']);
    });

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// middleware('verified');
