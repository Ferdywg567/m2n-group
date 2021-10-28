<?php

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


    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('promo', 'PromoController');
    Route::resource('banner', 'BannerController');
    Route::resource('layout', 'LayoutController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('customer', 'CustomerController');

});


//offline
Route::group(['prefix' => 'admin/offline', 'namespace' => 'Ecommerce\Offline', 'middleware' => ['role:admin-offline', 'auth'], 'as' => 'offline.'], function () {

    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::get('getdetailproduk', 'TransaksiController@getDataProduk')->name('getdetail');
        Route::get('getdatatable', 'TransaksiController@getDataDetail')->name('gettable');
        Route::get('cektransaksi', 'TransaksiController@cekTransaksi')->name('cek');
        Route::get('delete_transaksi/{kode}', 'TransaksiController@delete_data')->name('delete_trans');
        Route::get('cetak/{id}', 'TransaksiController@cetak')->name('cetak');
        Route::post('update_detail_barang', 'TransaksiController@update_detail_barang')->name('update_detail_barang');
    });

    Route::group(['prefix' => 'rekapitulasi', 'as' => 'rekapitulasi.'], function () {
        Route::get('cetak/{id}', 'RekapitulasiController@cetak')->name('cetak');
        Route::get('cetak_semua', 'RekapitulasiController@cetak_semua')->name('cetak_semua');
    });

    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
});
