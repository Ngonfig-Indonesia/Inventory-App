<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarItemController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangExpController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\TelegramController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/prosesLogin', [AuthController::class, 'login'])->name('cek_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cek_login:admin']], function(){
        Route::get('/admin', [HomeController::class, 'home'])->name('dashboard');
        // === DAFTAR ITEM BARANG ===
        Route::get('/admin/daftarbarang', [DaftarItemController::class, 'index'])->name('daftaritem');
        Route::post('/admin/daftarbarang/create', [DaftarItemController::class, 'store'])->name('createitem');
        Route::get('/admin/daftarbarang/barangedit/{id}', [DaftarItemController::class, 'edit'])->name('edititem');
        Route::put('/admin/daftarbarang/barangedit/update/{id}', [DaftarItemController::class, 'update'])->name('updateitem');
        Route::get('/admin/daftarbarang/delete/{id}', [DaftarItemController::class, 'destroy'])->name('delete');
        Route::post('/admin/daftarbarang/import', [DaftarItemController::class, 'import'])->name('importitem');
        Route::get('/admin/daftarbarang/export', [DaftarItemController::class, 'export'])->name('exportitem');

        // === BARANG ITEM MASUK ===
        Route::get('/admin/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk');
        Route::post('/admin/barangmasuk/create', [BarangMasukController::class, 'store'])->name('storemasuk');
        Route::get('/admin/barangmasuk/barangedit/{id}', [BarangMasukController::class, 'edit'])->name('edit.barangmasuk');
        Route::put('/admin/barangmasuk/barangedit/update/{id}', [BarangMasukController::class, 'update'])->name('update.barangmasuk');
        Route::get('/admin/barangmasuk/delete/{id}', [BarangMasukController::class, 'destroy'])->name('delete.barangmasuk');
        Route::get('/admin/barangmasuk/select2', [DaftarItemController::class, 'select2'])->name('select2');
        Route::get('/admin/barangmasuk/search', [BarangMasukController::class, 'search'])->name('searchmasuk');
        
        // === BARANG KELUAR ===
        Route::get('/admin/daftarbarangkeluar', [BarangKeluarController::class, 'listbarangkeluar'])->name('listbarang');
        Route::get('/admin/barangkeluar/showbarangkeluar/{id}', [BarangKeluarController::class, 'showBarangKeluar'])->name('showlistbarangkeluar');
        Route::put('/admin/barangkeluar/showbarangkeluar/update/{id}', [BarangKeluarController::class, 'approve'])->name('approve.list');
        Route::get('/admin/barangkeluar/showbarangkeluar/{id}/delete', [BarangKeluarController::class, 'delete'])->name('delete.list');
        // === BARANG EXP ===
        Route::get('/admin/barangexp', [BarangExpController::class, 'index'])->name('barangexp');

        // === LAPORAN BARANG ===
        Route::get('/admin/laporanbarangmasuk', [LaporanController::class, 'index'])->name('laporanmsuk');
        Route::get('/admin/laporanbarangkeluar', [LaporanController::class, 'indexkeluar'])->name('laporankeluar');
        Route::get('/admin/laporanbarangmasuk/search', [LaporanController::class, 'search'])->name('laporanmsuksearch');
        Route::get('/admin/laporanbarangkeluar/search', [LaporanController::class, 'searchkeluar'])->name('laporankeluarsearch');

        // === PROFILE ====
        Route::get('/admin/profile/adduser', [AuthController::class, 'profile'])->name('profile');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/admin/profile/adduser/register', [AuthController::class, 'prosesRegister'])->name('cek_register');
        Route::get('/admin/profile/user/{id}', [AuthController::class, 'user'])->name('user_id');
        
        // === TELEGRAM BOT ===
        // Route::get('/admin/telegram/send', [TelegramController::class, 'index']);
        // Route::post('/admin/telegram', [TelegramController::class, 'storeMessage'])->name('create.telegram');
    });
    
    Route::group(['middleware' => ['cek_login:cs']], function(){
        Route::get('/user', [HomeController::class, 'homeuser'])->name('dashboard.user');
        Route::get('/user/barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');
        Route::get('/user/barangkeliar/delete/{id}', [BarangKeluarController::class, 'destroy'])->name('delete.barangkeluar');
        Route::get('/user/listbarang/listbarangkeluar', [BarangKeluarController::class, 'listbarang'])->name('list.barang');
        Route::post('/user/listbarang/listbarangkeluar/create', [BarangKeluarController::class, 'store'])->name('storekeluar');
        Route::get('/user/listbarang/listbarangkeluar/select3', [DaftarItemController::class, 'select3'])->name('select3');
    });
});
