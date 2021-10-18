<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Ecommerce\Admin', 'middleware' => ['role:admin', 'auth'], 'as' => 'ecommerce.'], function () {


    //produk
    Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
        Route::get('getdetailproduk', 'ProdukController@getDetailProduk')->name('getdetail');
    });


    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('promo', 'PromoController');
    Route::resource('banner', 'BannerController');
    Route::resource('layout', 'LayoutController');
});
