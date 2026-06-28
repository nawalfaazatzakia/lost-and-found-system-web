<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminApprovalController;

Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index']);
    Route::post('/', [ReportController::class, 'store']);
    Route::get('/{id}', [ReportController::class, 'show']);
    Route::delete('/{id}', [ReportController::class, 'destroy']);
});

Route::prefix('claims')->group(function () {
    Route::get('/', [ClaimController::class, 'index']);
    Route::post('/', [ClaimController::class, 'store']);
    Route::get('/{id}', [ClaimController::class, 'show']);
});

Route::prefix('admin')->group(function () {
    Route::get('/claims/pending', [AdminApprovalController::class, 'pending']);
    Route::post('/claims/{id}/approve', [AdminApprovalController::class, 'approve']);
    Route::post('/claims/{id}/reject', [AdminApprovalController::class, 'reject']);
});

Route::prefix('chat')->group(function () {
    Route::post('/send', [ChatController::class, 'send']);
    Route::get('/messages/{claimId}', [ChatController::class, 'messages']);
    Route::post('/read/{id}', [ChatController::class, 'markRead']);
});