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

Route::get('/', [HomeController::class, 'index']);

Route::get('auth', [AuthController::class, 'index']);
Route::resource('profile', ProfileController::class)->middleware('web');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('code', [HomeController::class, 'code']);
Route::put('/code/update/{id}', [HomeController::class, 'update'])->name('code.update');
Route::get('/code/{id}', [HomeController::class, 'show']);

Route::get('admin', [AdminController::class, 'index']);
Route::resource('admin/akun', AkunController::class)->middleware('web');
Route::resource('admin/template', TemplateController::class)->middleware('web');


















































Route::group(['middleware' => 'check.site.status'], function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::resource('admin/akun', AkunController::class)->middleware('web');
    Route::resource('admin/template', TemplateController::class)->middleware('web');
});