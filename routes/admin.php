<?php

use App\Http\Controllers\Ecommerce\Admin\TransaksiController;
use Illuminate\Support\Facades\Route;

//online

Route::group(['prefix' => 'admin', 'namespace' => 'Ecommerce\Admin', 'middleware' => ['role:admin-online', 'auth'], 'as' => 'ecommerce.'], function () {


    //produk
    Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
        Route::get('getdetailproduk', 'ProdukController@getDetailProduk')->name('getdetail');
        Route::get('getdetailimage', 'ProdukController@getDetailImage')->name('getdetailimage');
        Route::post('/update','ProdukController@update_data')->name('updatedata');
    });

    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
        Route::post('/update','BannerController@update_data')->name('updatedata');
    });
    Route::group(['prefix' => 'bank', 'as' => 'bank.'], function () {
        Route::post('/update','BankController@update_data')->name('updatedata');
    });
    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::get('/download/{id}','TransaksiController@download')->name('download');
        Route::get('/get_alamat','TransaksiController@getAlamat')->name('get_alamat');
        Route::post('/retur', [TransaksiController::class, 'retur'])->name('retur');
        Route::post('/refund', [TransaksiController::class, 'refund'])->name('refund');
    });

    Route::group(['prefix' => 'notifikasi', 'as' => 'notifikasi.'], function () {
        Route::get('notifikasi-read', 'NotifikasiController@read')->name('notifikasi.read');
        Route::get('notifikasi-read-klik', 'NotifikasiController@readklik')->name('notifikasi.readklik');
    });
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/transaksi', 'DashboardController@transaksi')->name('transaksi');
    });
    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('promo', 'PromoController');
    Route::resource('banner', 'BannerController');
    Route::resource('layout', 'LayoutController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('customer', 'CustomerController');
    Route::resource('bank', 'BankController');
    Route::resource('notifikasi','NotifikasiController');
    Route::resource('karyawan', 'KaryawanController');
    // Route::resource('cetak_label', 'CetakLabelController');
});


//offline
Route::group(['prefix' => 'admin/offline', 'namespace' => 'Ecommerce\Offline', 'middleware' => ['role:admin-offline', 'auth'], 'as' => 'offline.'], function () {

    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::get('getdetailproduk', 'TransaksiController@getDataProduk')->name('getdetail');
        Route::get('getdatatable', 'TransaksiController@getDataDetail')->name('gettable');
        Route::get('cektransaksi', 'TransaksiController@cekTransaksi')->name('cek');
        Route::get('delete_transaksi/{kode}/{ukuran}', 'TransaksiController@delete_data')->name('delete_trans');
        Route::get('cetak/{id}', 'TransaksiController@cetak')->name('cetak');
        Route::post('update_detail_barang', 'TransaksiController@update_detail_barang')->name('update_detail_barang');
    });

    Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
        Route::get('getdetailproduk', 'ProdukController@getDetailProduk')->name('getdetail');
        Route::get('getdetailimage', 'ProdukController@getDetailImage')->name('getdetailimage');
        Route::post('/update','ProdukController@update_data')->name('updatedata');
    });


    Route::group(['prefix' => 'rekapitulasi', 'as' => 'rekapitulasi.'], function () {
        Route::get('cetak/{id}', 'RekapitulasiController@cetak')->name('cetak');
        Route::get('cetak_semua', 'RekapitulasiController@cetak_semua')->name('cetak_semua');
    });

    Route::group(['prefix' => 'cetak_label', 'as' => 'cetak_label.'], function () {
        Route::get('cetak', 'CetakLabelController@cetak')->name('cetak');
    });
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/transaksi', 'DashboardController@transaksi')->name('transaksi');
    });
    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('cetak_label', 'CetakLabelController');
});
