<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index']);
Route::post('/upload', [HomeController::class, 'prosesUpload']);
Route::post('/hapusfile', [HomeController::class, 'prosesUpload']);
Route::post('/download', [HomeController::class, 'download']);
Route::post('/hapus', [HomeController::class, 'hapus']);
