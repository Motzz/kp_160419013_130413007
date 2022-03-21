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
/*Route::get('/home/master/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
Route::get('/home/master/role/tambah', [App\Http\Controllers\RoleController::class, 'tambah'])->name('roletambah');
Route::get('/home/master/role/edit', [App\Http\Controllers\RoleController::class, 'index'])->name('roleedit');*/
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


/*==================================yang belom==========================================*/ 
//Menu (ex:master, home, pemesanan, profil, dll) 
Route::resource('menu', 'App\Http\Controllers\MenuController');
    
//SubMenu (ex:barang_tambah, barang_edit, npp_tambah, po_tambah, dll   nyimpen id menu) 
Route::resource('submenu', 'App\Http\Controllers\SubMenuController');

//UserAccess (mnm dari 2 diatas) (ex:nama e tambah apa , access nya itu boolean (1 dan 0) nyimpen id submenu, dll) 
Route::resource('userAccess', 'App\Http\Controllers\UserAccessController');


//fixed ***********************************************************

//item baru
Route::resource('item', 'App\Http\Controllers\ItemController');//
Route::get('/iteme/searchname/',[App\Http\Controllers\ItemController::class, 'searchItemName']); //cobak gini ta
Route::get('/iteme/searchtag/',[App\Http\Controllers\ItemController::class, 'searchItemTagName']); //cobak gini ta
Route::get('/iteme/searchtagmulti/',[App\Http\Controllers\ItemController::class, 'searchItemTagMulti']); //cobak gini ta
//Route::get('/item/searchname/', [App\Http\Controllers\ItemController::class, 'searchItemName'])->name('searchItemName');

Route::resource('itemCategory', 'App\Http\Controllers\ItemCategoryController');//selese,delete masik gbs
Route::resource('ItemTag', 'App\Http\Controllers\ItemTagController');//selese,delete masik gbs
Route::resource('itemTracing', 'App\Http\Controllers\ItemTracingController');//selese,delete masik gbs
Route::resource('itemTransaction', 'App\Http\Controllers\ItemTransactionController');//selese,delete masik gbs
Route::resource('itemType', 'App\Http\Controllers\ItemTypeController');//selese,delete masik gbs

//COA baru
Route::resource('coa', 'App\Http\Controllers\COAController');
Route::resource('coaDetail', 'App\Http\Controllers\COADetailController');
Route::resource('coaHead', 'App\Http\Controllers\COAHeadController');

//MGudang dan lainlain
Route::resource('mGudang', 'App\Http\Controllers\MGudangController');
Route::resource('mGudangAreaSimpan', 'App\Http\Controllers\MGudangAreaSimpanController');
Route::resource('mGudangValues', 'App\Http\Controllers\MGudangValuesController');
Route::resource('mKota', 'App\Http\Controllers\MKotaController');
Route::resource('mPerusahaan', 'App\Http\Controllers\MPerusahaanController');
Route::resource('mProvinsi', 'App\Http\Controllers\MProvinsiController');
Route::resource('mPulau', 'App\Http\Controllers\MPulauController');

//payment and paymentterms
Route::resource('payment', 'App\Http\Controllers\PaymentController');
Route::resource('paymentTerms', 'App\Http\Controllers\PaymentTermsController');

//mSupplier
Route::resource('msupplier', 'App\Http\Controllers\MSupplierController');//selese,delete masik gbs

