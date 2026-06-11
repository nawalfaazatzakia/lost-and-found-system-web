<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [ReportController::class,'index']);

Route::get('/verification',[ClaimController::class,'index']);

Route::post('/claim/{id}',[ClaimController::class,'store']);

Route::get('/admin',[AdminController::class,'index']);

Route::get('/pickup/{id}',[PickupController::class,'show']);

Route::post('/chat/send',[ChatController::class,'send']);
