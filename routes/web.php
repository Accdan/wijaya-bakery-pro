<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\TagsController;

// Import middleware IsAdmin
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RedirectIfNotAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login-admin', [AuthController::class, 'showAdminLoginForm'])->name('login-admin');
Route::post('/login-admin', [AuthController::class, 'adminLogin']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('kategori', KategoriController::class);
Route::resource('menu', MenuController::class);

// Group route admin dengan middleware auth + isAdmin
// Route::name('admin.')->middleware(['auth', RedirectIfNotAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('role', RoleController::class);
    Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');

    Route::resource('user', UserController::class);

    Route::post('/menu/{id}/like', [LikesController::class, 'toggle'])->name('menu.like');
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');

    Route::get('/ingredients/menu/{menu_id}', [IngredientsController::class, 'indexByMenu']);
    Route::post('/ingredients', [IngredientsController::class, 'store']);
    Route::put('/ingredients/{id}', [IngredientsController::class, 'update']);
    Route::delete('/ingredients/{id}', [IngredientsController::class, 'destroy']);

    Route::resource('tags', TagsController::class);
// });
