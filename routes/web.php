<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'check.site.status'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/code', [HomeController::class, 'code']);
    Route::get('/code/{id}', [HomeController::class, 'show']);
    Route::get('/live-demo/{id}', [HomeController::class, 'demo']);

    // Authentication routes
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/auth', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Authenticated routes
    Route::middleware(['auth'])->group(function () {
        Route::resource('profile', ProfileController::class);
        Route::put('/password/update/{id}', [ProfileController::class, 'password'])->name('password.update');
        Route::put('/templates/update/{id}', [ProfileController::class, 'templates'])->name('templates.update');
        Route::put('/code/update/{id}', [HomeController::class, 'update'])->name('code.update');

        // Admin routes
        Route::middleware(['role:admin'])->group(function () {
            Route::get('admin', [AdminController::class, 'index']);
            Route::resource('admin/akun', AkunController::class);
            Route::resource('admin/template', TemplateController::class);
        });
    });
});
