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
use App\Http\Controllers\DashboardUserController;

// Import middleware IsAdmin
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RedirectIfNotAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/login-user', [AuthController::class, 'showUserLoginForm'])->name('login-user');
// Route::get('/login-user', [AuthController::class, 'showUserLoginForm'])->name('login');
Route::post('/login-user', [AuthController::class, 'userLogin']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login-admin', [AuthController::class, 'showAdminLoginForm'])->name('login-admin');
Route::post('/login-admin', [AuthController::class, 'adminLogin'])->name('login-admin.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('menu', MenuController::class);

// Group route admin dengan middleware auth + isAdmin
Route::name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.admin');

    Route::resource('role', RoleController::class);
    Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');

    Route::resource('user', UserController::class);

    Route::resource('kategori', KategoriController::class);

    Route::post('/menu/{id}/like', [LikesController::class, 'toggle'])->name('menu.like');
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');

    Route::get('/ingredients/menu/{menu_id}', [IngredientsController::class, 'indexByMenu']);
    Route::post('/ingredients', [IngredientsController::class, 'store']);
    Route::put('/ingredients/{id}', [IngredientsController::class, 'update']);
    Route::delete('/ingredients/{id}', [IngredientsController::class, 'destroy']);

    Route::resource('tags', TagsController::class);
});

Route::name('users')->middleware('users')->group(function () {
    Route::get('/homepage', [DashboardUserController::class, 'homepage'])->name('users.homepage.user');
    Route::get('/dashboard-user', [DashboardUserController::class, 'index'])->name('users.dashboard.user');
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::get('/menu/{id}/detail', [MenuController::class, 'detail'])->name('menu.detail');
});

require base_path('routes/api.php');
