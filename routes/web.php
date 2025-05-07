<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('role', RoleController::class);
Route::get('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('pengguna', PenggunaController::class);
