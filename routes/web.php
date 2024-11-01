<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\DataOperatorController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\SuratKeluarController;

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
    return view('auth.login');
});

Route::get('/offline', function () {
    return view('offline');
});

Auth::routes();

Route::put('suratmasuk/{id}/tindakan', [SuratMasukController::class, 'updateTindakan'])->name('suratmasuk.updateTindakan');

Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.show');

Route::middleware(['role:admin|sekretaris|kepaladinas'])->group(function () {
    Route::resource('suratmasuk', SuratMasukController::class);
});

Route::get('disposisi/{id}/print', [App\Http\Controllers\DisposisiController::class, 'print'])->name('disposisi.print');

Route::get('bidang/all', [BidangController::class, 'all']);
Route::resource('bidang', BidangController::class);

Route::resource('disposisi', DisposisiController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('post/{id}/delete', [PostController::class, 'delete'])->name('delete');

Route::resource('dataoperator', DataOperatorController::class);
Route::get('dataoperator/{id}/password', [DataOperatorController::class, 'editPassword'])->name('dataoperator.password');
Route::get('dataoperator/{id}/role', [DataOperatorController::class, 'editRole'])->name('dataoperator.role');
Route::patch('dataoperator/{id}/password', [DataOperatorController::class, 'updatePassword'])->name('dataoperator.updatePassword');
Route::patch('dataoperator/{id}/role', [DataOperatorController::class, 'updateRole'])->name('dataoperator.updateRole');

Route::resource('suratkeluar', SuratKeluarController::class);
