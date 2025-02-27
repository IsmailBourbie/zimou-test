<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackagesExportController;
use App\Http\Controllers\PackagesExportDownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::middleware(['auth'])->get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::middleware(['auth'])->post('/packages', [PackageController::class, 'store'])->name('packages.store');

Route::get('/packages/export', PackagesExportController::class)->name('packages.export');

Route::get('/packages/exports/download/{filename}', PackagesExportDownloadController::class)
    ->name('exports.download')
    ->middleware(['signed', 'auth']);


