<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\ClaimController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\ClaimReviewController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES — bisa diakses siapa saja tanpa login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| AUTH USER (Mahasiswa)
|--------------------------------------------------------------------------
*/

Route::prefix('login')->name('user.')->group(function () {
    Route::get('/',          [LoginController::class, 'showUserLogin'])->name('login');
    Route::post('/',         [LoginController::class, 'userLogin'])->name('login.post');
    Route::post('/logout',   [LoginController::class, 'userLogout'])->name('logout');
});

Route::prefix('daftar')->name('user.register.')->group(function () {
    Route::get('/',   [RegisterController::class, 'showForm'])->name('show');
    Route::post('/',  [RegisterController::class, 'store'])->name('store');
});


/*
|--------------------------------------------------------------------------
| AUTH ADMIN — route login admin terpisah dari user
|--------------------------------------------------------------------------
*/

Route::prefix('admin/login')->name('admin.')->group(function () {
    Route::get('/',         [LoginController::class, 'showAdminLogin'])->name('login');
    Route::post('/',        [LoginController::class, 'adminLogin'])->name('login.post');
    Route::post('/logout',  [LoginController::class, 'adminLogout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| USER ROUTES — harus login sebagai mahasiswa
| Middleware: auth, role:mahasiswa
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('user.')->group(function () {

    // Beranda — daftar semua barang
    Route::get('/beranda', [ItemController::class, 'index'])->name('beranda');

    // Laporan barang
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/',           [ItemController::class, 'index'])->name('index');
        Route::get('/buat',       [ItemController::class, 'create'])->name('create');
        Route::post('/',          [ItemController::class, 'store'])->name('store');
        Route::get('/{id}',       [ItemController::class, 'show'])->name('show');
    });

    // Klaim barang
    Route::prefix('klaim')->name('klaim.')->group(function () {
        Route::get('/{item_id}',  [ClaimController::class, 'create'])->name('create');
        Route::post('/',          [ClaimController::class, 'store'])->name('store');
        Route::get('/status/{id}',[ClaimController::class, 'status'])->name('status');
    });

    // Lokasi pengambilan (setelah klaim disetujui)
    Route::get('/pickup/{claim_id}', [ClaimController::class, 'pickup'])->name('pickup');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES — harus login sebagai admin
| Middleware: auth, role:admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen barang — lihat daftar & detail
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/',           [ItemReviewController::class, 'index'])->name('index');
        Route::get('/{id}',       [ItemReviewController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [ItemReviewController::class, 'updateStatus'])->name('status');
    });

    // Review & approval klaim
    Route::prefix('klaim')->name('klaim.')->group(function () {
        Route::get('/',           [ClaimReviewController::class, 'index'])->name('index');
        Route::get('/{id}',       [ClaimReviewController::class, 'show'])->name('show');        // detail + hasil QA
        Route::patch('/{id}/keputusan', [ClaimReviewController::class, 'decide'])->name('decide'); // setujui / tolak
    });

    // Manajemen user
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/',           [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/{id}',       [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
        Route::delete('/{id}',    [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    });
});


/*
|--------------------------------------------------------------------------
| FALLBACK — redirect ke login jika route tidak ditemukan
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect()->route('home');
});