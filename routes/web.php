<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->get('/packages', [PackageController::class, 'index'])->name('packages.index');
