<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CodeController;
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
Route::get('code', [HomeController::class, 'code']);
Route::get('/code/{id}', [HomeController::class, 'show']);


Route::get('admin', function () {
    return view('admin/index');
});
Route::resource('admin/akun', AkunController::class)->middleware('web');
Route::resource('admin/template', TemplateController::class)->middleware('web');
