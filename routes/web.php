<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,'welcome'])->name('welcome');

Route::get('/advertisements/create', [AdvertisementController::class,'create'])->name('advertisement.create')->middleware('auth');
Route::get('/advertisements/index', [AdvertisementController::class,'index'])->name('advertisement.index');
Route::get('/advertisements/show/{advertisement}', [AdvertisementController::class,'show'])->name('advertisement.show');