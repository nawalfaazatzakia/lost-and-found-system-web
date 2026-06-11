<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/verification', function () {
    return view('verification');
})->name('verification');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/pickup', function () {
    return view('picup');
})->name('pickup');
