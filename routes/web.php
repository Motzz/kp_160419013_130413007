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
Route::get('/home/master/barang/tambah', [App\Http\Controllers\BarangController::class, 'index'])->name('barangtambah');
Route::get('/home/master/barang/edit', [App\Http\Controllers\BarangController::class, 'index'])->name('barangedit');
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



/*Proses_Transaksi    - no debug still dont know*/
Route::get('/home/master/prosesTransaksi', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksi');
Route::get('/home/master/prosesTransaksi/tambah', [App\Http\Controllers\ProsesTransaksiController::class, 'create'])->name('transaksiTambah'); //create nama method di controller
Route::get('/home/master/prosesTransaksi/edit', [App\Http\Controllers\ProsesTransaksiController::class, 'index'])->name('transaksiEdit');
Route::resource('transaksi', 'App\Http\Controllers\ProsesTransaksiController');

/*Lokasi */
Route::resource('lokasi', 'App\Http\Controllers\LokasiController');


/*PT*/
Route::resource('pt', 'App\Http\Controllers\PTController');
/*Gudang */
Route::resource('gudang', 'App\Http\Controllers\GudangController');

/*supplier   - no debug still dont know  belum dibuat blade nya*/
Route::resource('supplier', 'App\Http\Controllers\SupplierController');

/*bank   - no debug still dont know  belum dibuat blade nya*/
Route::resource('bank', 'App\Http\Controllers\BankController');

//Purchase Request 
Route::resource('purchaseRequest', 'App\Http\Controllers\PurchaseRequestController');

//Info Supplier (ex:tik, alat tulis, gadget, dll) 
Route::resource('infoSupplier', 'App\Http\Controllers\InfoSupplierController');

//Menu (ex:master, home, pemesanan, profil, dll) 
Route::resource('menu', 'App\Http\Controllers\MenuController');\
    
//SubMenu (ex:barang_tambah, barang_edit, npp_tambah, po_tambah, dll   nyimpen id menu) 
Route::resource('submenu', 'App\Http\Controllers\SubMenuController');

//UserAccess (mnm dari 2 diatas) (ex:nama e tambah apa , access nya itu boolean (1 dan 0) nyimpen id submenu, dll) 
Route::resource('userAccess', 'App\Http\Controllers\UserAccessController');
