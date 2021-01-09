<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/admin', function () {
     return view('admin.index');
 })->middleware('auth');

 Route::get('/home', function () {
     return view('admin.index');
 })->middleware('auth');


Route::get('/logout', 'Auth\LoginController@logout');

// CRUD ORDERAN //
Route::get('/input_orderan', 'OrderController@index');
Route::POST('/input_orderan', 'OrderController@store');
Route::get('/lihat_orderan', 'OrderController@lihat_orderan');
Route::get('/lihat_orderan/detail/{id}', 'OrderController@show');
Route::get('/edit_orderan/{id}', 'OrderController@edit');
Route::PATCH('/edit_orderan/{id}', 'OrderController@update');

//CRUD STOK BARANG //
Route::get('/stok', 'StokController@index');
Route::get('/show_stok/{id}', 'StokController@show');
Route::get('/print_stok/{nama_loker}', 'StokController@print_stok');

// SUDAH DAN BELUM DIBYAR PENGGAJIAN KARYAWAN //
Route::get('/sudah_di_bayar', 'GajiKaryawanController@sudah_di_bayar');
Route::get('/belum_di_bayar', 'GajiKaryawanController@belum_di_bayar');
Route::get('/all_list', 'GajiKaryawanController@history');


//CRUD MASTER DATA PENGGAJIAN KARYAWAN
Route::get('/penggajian/dashboard', 'MasterDataController@master_gaji');
Route::get('/penggajian/masterdata/sudah_di_bayar', 'MasterDataController@sudah_di_bayar');
Route::get('/penggajian/masterdata/belum_di_bayar', 'MasterDataController@belum_di_bayar');
Route::get('/penggajian/masterdata/all_list', 'MasterDataController@all_list');
Route::get('/penggajian/masterdata/edit_pembayaran/{id}', 'MasterDataController@edit_pembayaran');
Route::PATCH('/penggajian/masterdata/edit_pembayaran/{id}', 'MasterDataController@update_pembayaran');
Route::get('/penggajian/masterdata/hapus_pembayaran/{id}', 'MasterDataController@destroy_pembayaran');
Route::get('/penggajian/add_potong', 'MasterDataController@add_potong');
Route::POST('/penggajian/add_potong', 'MasterDataController@store_potong');
Route::get('/penggajian/add_jahit', 'MasterDataController@add_jahit');
Route::POST('/penggajian/add_jahit', 'MasterDataController@store_jahit');
Route::get('/penggajian/ubah_status_pembayaran/{id}', 'MasterDataController@ubah_status_pembayaran');


//CRUD MASTER DATA STOK BARANG//
Route::get('/master_stok', 'MasterDataController@master_stok');
Route::get('/lihat_stok/{nama_loker}', 'MasterDataController@show_stok');
Route::POST('/input_master_stok', 'MasterDataController@input_master_stok');
Route::get('/edit_stok/{id}', 'MasterDataController@edit_stok');
Route::PATCH('/edit_stok/{id}', 'MasterDataController@update_stok');
Route::get('/hapus_stok/{id}', 'MasterDataController@destroy_stok');

//CRUD MASTER DATA ORDERAN
Route::get('/master_orderan', 'MasterDataController@master_orderan');
Route::get('/orderan/hapus_orderan/{id}', 'MasterDataController@destroy_orderan');

//CRUD MASTER DATA ACCOUNT
Route::get('/master_akun', 'MasterDataController@master_akun');
Route::get('/master_akun/edit/{id}', 'MasterDataController@edit_akun');
Route::get('/master_akun/hapus_akun/{id}', 'MasterDataController@destroy_akun');
Route::PATCH('/master_akun/update/{id}', 'MasterDataController@update_akun');
Route::PATCH('/master_akun/update_pw/{id}', 'MasterDataController@update_pw');
Route::post('/master_akun/add', 'MasterDataController@add_akun');


//ORDERAN BELUM DI PROSES
Route::get('/orderan/belum_proses', 'OrderController@belum_proses');

//ORDERAN MULAI PRODUKSI
Route::get('/on_proses', 'OrderController@on_proses');
Route::get('/orderan/mulai_produksi/{id}', 'OrderController@mulai_produksi');

//ORDERAN SIAP KIRIM //
Route::get('/orderan/selesai_produksi/{id}', 'OrderController@selesai_produksi');
Route::get('/siap_kirim', 'OrderController@siap_kirim');

// ORDERAN SELESAI //
Route::get('/orderan/selesai_produksi', 'OrderController@selesai_produksi');
Route::get('/orderan_selesai', 'OrderController@orderan_selesai');

//CETAK INVOICE
Route::get('/orderan/cetak_invoice/{id}', 'OrderController@cetak_invoice');

//OMSET BULANAN
Route::get('/omset_bulanan', 'OmsetContoller@index');
Route::POST('/omset_bulanan', 'OmsetContoller@cari_omset');
//OMSET TAHUNAN
Route::get('/omset_tahunan', 'OmsetContoller@omset_tahunan');
Route::POST('/omset_tahunan', 'OmsetContoller@cari_omset_tahunan');

//PROFILE
Route::get('/profile/{id}', 'AkunController@index');
Route::PATCH('/update_profile/{id}', 'AkunController@update');
Route::PATCH('/update_profile/update_pw/{id}', 'AkunController@update_pw');






