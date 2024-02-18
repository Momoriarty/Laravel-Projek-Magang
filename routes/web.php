<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\HomeController;
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
    Route::get('/kategori/{id}', [HomeController::class, 'kategori']);
    Route::get('/code/{id}', [HomeController::class, 'show']);
    Route::put('/code/update/{id}', [HomeController::class, 'update'])->name('code.update');
    Route::get('/live-demo/{id}', [HomeController::class, 'demo']);

    // Authentication routes
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/auth', [AuthController::class, 'index']);
    
    Route::get('/forgot_password', [AuthController::class, 'forgot']);
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/updatef', [AuthController::class, 'resetpassword'])->name('password.updatef');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Authenticated routes
    Route::middleware(['auth'])->group(function () {
        Route::resource('profile', ProfileController::class);
        Route::put('/password/update/{id}', [ProfileController::class, 'password'])->name('password.update');
        Route::put('/templates/update/{id}', [ProfileController::class, 'templates'])->name('templates.update');

        // Admin routes
        Route::middleware(['role:team,admin'])->group(function () {
            Route::get('admin', [AdminController::class, 'index']);
            Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
            Route::put('admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
            Route::delete('admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
            Route::resource('admin/akun', AkunController::class);
            Route::resource('admin/template', TemplateController::class);
            Route::resource('admin/kategori', KategoriController::class);
        });
    });
});
