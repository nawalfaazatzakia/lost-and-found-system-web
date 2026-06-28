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
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [ItemController::class, 'index'])->name('home');

Route::get('/verification', function () {
    return view('verification');
})->name('verification');


/*
|--------------------------------------------------------------------------
| AUTH (LOGIN SATU UNTUK SEMUA)
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login');
Route::post('/login', [LoginController::class, 'userLogin'])->name('login.post');
Route::post('/logout', [LoginController::class, 'userLogout'])->name('logout');

Route::get('/daftar', [RegisterController::class, 'showForm'])->name('register.show');
Route::post('/daftar', [RegisterController::class, 'store'])->name('register.store');


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->prefix('mahasiswa')->name('user.')->group(function () {

    Route::get('/beranda', [ItemController::class, 'index'])->name('beranda');

    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('index');
        Route::get('/buat', [ItemController::class, 'create'])->name('create');
        Route::post('/', [ItemController::class, 'store'])->name('store');
        Route::get('/{id}', [ItemController::class, 'show'])->name('show');
    });

    Route::prefix('klaim')->name('klaim.')->group(function () {
        Route::get('/{item_id}', [ClaimController::class, 'create'])->name('create');
        Route::post('/', [ClaimController::class, 'store'])->name('store');
        Route::get('/status/{id}', [ClaimController::class, 'status'])->name('status');
    });

    Route::get('/pickup/{claim_id}', [ClaimController::class, 'pickup'])->name('pickup');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [ItemReviewController::class, 'index'])->name('index');
        Route::get('/{id}', [ItemReviewController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [ItemReviewController::class, 'updateStatus'])->name('status');
    });

    Route::prefix('klaim')->name('klaim.')->group(function () {
        Route::get('/', [ClaimReviewController::class, 'index'])->name('index');
        Route::get('/{id}', [ClaimReviewController::class, 'show'])->name('show');
        Route::patch('/{id}/keputusan', [ClaimReviewController::class, 'decide'])->name('decide');
    });
});


Route::fallback(function () {
    return redirect()->route('home');
});