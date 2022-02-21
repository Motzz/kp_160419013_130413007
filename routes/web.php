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

/*Proses_Transaksi    - no debug still dont know*/
Route::get('/home/master/prosesTransaksi', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksi');
Route::get('/home/master/prosesTransaksi/tambah', [App\Http\Controllers\ProsesTransaksiController::class, 'create'])->name('transaksiTambah'); //create nama method di controller
Route::get('/home/master/prosesTransaksi/edit', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksiEdit');
Route::resource('transaksi', 'App\Http\Controllers\ProsesTransaksiController');

/*Lokasi   - no debug still dont know*/
Route::get('/home/master/lokasi', [App\Http\Controllers\LokasiController::class, 'index'])->name('lokasi');
Route::get('/home/master/lokasi/tambah', [App\Http\Controllers\LokasiController::class, 'create'])->name('lokasiTambah'); //create nama method di controller
Route::get('/home/master/lokasi/edit', [App\Http\Controllers\LokasiController::class, 'index'])->name('lokasiEdit');
Route::resource('lokasi', 'App\Http\Controllers\LokasiController');

/*Gudang   - no debug still dont know*/
Route::get('/home/master/gudang', [App\Http\Controllers\GudangController::class, 'index'])->name('gudang');
Route::get('/home/master/gudang/tambah', [App\Http\Controllers\GudangController::class, 'create'])->name('gudangTambah'); //create nama method di controller
Route::get('/home/master/gudang/edit', [App\Http\Controllers\GudangController::class, 'index'])->name('gudangEdit');
Route::resource('gudang', 'App\Http\Controllers\GudangController');

/*Gudang   - no debug still dont know  belum dibuat blade nya*/
Route::get('/home/master/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier');
Route::get('/home/master/supplier/tambah', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplierTambah'); //create nama method di controller
Route::get('/home/master/supplier/edit', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplierEdit');
Route::resource('supplier', 'App\Http\Controllers\SupplierController');