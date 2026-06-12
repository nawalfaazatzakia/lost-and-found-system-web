<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ChatController;

Route::get('/', [ReportController::class,'index'])->name('home');
Route::get ('/verification', [ClaimController::class,'index'])->name('verification');

Route::get('/pickup', function () {
    return view ('pickup');
})->name('pickup');

Route::get('/admin', [AdminController::class,'index'])->name('admin');
Route::get('/pickup/{id}', [PickupController::class,'show'])->name('pickup.show');

Route::post('/chat/send', [ChatController::class,'send']);

