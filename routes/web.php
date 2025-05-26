<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
// use App\Http\Controllers\PenggunaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::resource('kategori', KategoriController::class);
Route::resource('menu', MenuController::class);
// Route::resource('pengguna', PenggunaController::class);

// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('/dashboard', [DashboardController::class, 'index']);
//     Route::resource('role', RoleController::class);
//     Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
//     Route::resource('user', UserController::class);
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
//});

