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

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/profile/edit', [App\Http\Controllers\ProfileEditController::class, 'index'])->name('profile_edit');

/*barang*/
Route::get('/home/master/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('barang');
Route::get('/home/master/barang/tambah', [App\Http\Controllers\BarangTambahController::class, 'index'])->name('barangtambah');
Route::get('/home/master/barang/edit', [App\Http\Controllers\BarangTambahController::class, 'index'])->name('barangedit');
Route::resource('barang', 'App\Http\Controllers\BarangController');

/*satuan*/
Route::get('/home/master/satuan', [App\Http\Controllers\SatuanController::class, 'index'])->name('satuan');
Route::get('/home/master/satuan/tambah', [App\Http\Controllers\SatuanTambahController::class, 'index'])->name('satuantambah');
Route::get('/home/master/satuan/edit', [App\Http\Controllers\SatuanTambahController::class, 'index'])->name('satuanedit');
Route::resource('satuan', 'App\Http\Controllers\SatuanController');

/*role*/
Route::get('/home/master/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
Route::get('/home/master/role/tambah', [App\Http\Controllers\RoleController::class, 'tambah'])->name('roletambah');
Route::get('/home/master/role/edit', [App\Http\Controllers\RoleController::class, 'index'])->name('roleedit');
Route::resource('role', 'App\Http\Controllers\RoleController');

/*PT*/
Route::get('/home/master/PT', [App\Http\Controllers\PTController::class, 'index'])->name('pt');
Route::get('/home/master/PT/tambah', [App\Http\Controllers\PTController::class, 'create'])->name('ptTambah'); //create nama method di controller
Route::get('/home/master/PT/edit', [App\Http\Controllers\PTController::class, 'index'])->name('ptEdit');
Route::resource('pt', 'App\Http\Controllers\PTController');

/*PT*/
Route::get('/home/master/prosesTransaksi', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksi');
Route::get('/home/master/prosesTransaksi/tambah', [App\Http\Controllers\ProsesTransaksiController::class, 'create'])->name('transaksiTambah'); //create nama method di controller
Route::get('/home/master/prosesTransaksi/edit', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksiEdit');
Route::resource('transaksi', 'App\Http\Controllers\ProsesTransaksiController');