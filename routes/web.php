<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/proseslogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/prosesregister', [RegisterController::class, 'prosesRegister'])->name('prosesRegister');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/upload', [HomeController::class, 'prosesUpload'])->name('prosesUpload')->middleware('auth');
Route::post('/download', [HomeController::class, 'download'])->name('download')->middleware('auth');
Route::post('/hapus', [HomeController::class, 'hapus'])->name('hapus')->middleware('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
