<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/profile/edit', [App\Http\Controllers\ProfileEditController::class, 'index'])->name('profile_edit');

Route::get('/home/master/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('barang');
Route::get('/home/master/barang/tambah', [App\Http\Controllers\BarangTambahController::class, 'index'])->name('barangtambah');
Route::get('/home/master/barang/edit', [App\Http\Controllers\BarangTambahController::class, 'index'])->name('barangedit');

Route::get('/home/master/satuan', [App\Http\Controllers\SatuanController::class, 'index'])->name('satuan');
Route::get('/home/master/satuan/tambah', [App\Http\Controllers\SatuanTambahController::class, 'index'])->name('satuantambah');
//Route::get('/home/master/satuan/tambahproses', [App\Http\Controllers\SatuanTambahController::class, 'create'])->name('satuantambahproses');
Route::get('/home/master/satuan/edit', [App\Http\Controllers\SatuanTambahController::class, 'index'])->name('satuanedit');
Route::resource('satuan', 'App\Http\Controllers\SatuanController');
//Route::get('/home/permintaan-pembelian', [App\Http\Controllers\::class, 'index'])->name('permintaan_pembelian');