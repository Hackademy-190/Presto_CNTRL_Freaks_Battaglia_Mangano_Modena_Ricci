<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,'welcome'])->name('welcome');
Route::get('/advertisements/create', [AdvertisementController::class,'create'])->name('advertisement.create');
