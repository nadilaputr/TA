<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\DataOperatorController;
use App\Models\SuratMasuk;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/disposisi', [App\Http\Controllers\DisposisiController::class, 'index']);

Route::prefix('surat')->group(function () {
    Route::resource('masuk', SuratMasukController::class);
    Route::put('masuk/{id}/tindakan', [SuratMasukController::class, 'updateTindakan'])->name('masuk.updateTindakan');
    Route::get('keluar', [App\Http\Controllers\SuratKeluarController::class, 'index']);
});

Route::delete('post/{id}/delete', [PostController::class, 'delete'])->name('delete');

Route::resource('dataoperator', DataOperatorController::class);
Route::get('dataoperator/{id}/password', [DataOperatorController::class, 'editPassword'])->name('dataoperator.password');
Route::get('dataoperator/{id}/role', [DataOperatorController::class, 'editRole'])->name('dataoperator.role');
Route::patch('dataoperator/{id}/password', [DataOperatorController::class, 'updatePassword'])->name('dataoperator.updatePassword');
Route::patch('dataoperator/{id}/role', [DataOperatorController::class, 'updateRole'])->name('dataoperator.updateRole');

Route::resource('bidang', BidangController::class);
