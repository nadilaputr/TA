<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/disposisi', [App\Http\Controllers\DisposisiController::class, 'index']);
// Route::get('/surat/masuk/tambah', [TambahSuratMasukController::class, 'index']);

Route::prefix('surat')->group(function () {
    Route::resource('masuk', SuratMasukController::class);
    Route::get('keluar', [App\Http\Controllers\SuratKeluarController::class, 'index']);
});

Route::delete('post/{id}/delete', [PostController::class, 'delete'])->name('delete');
