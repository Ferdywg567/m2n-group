<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Ecommerce\Admin', 'middleware' => ['role:admin', 'auth'], 'as' => 'ecommerce.'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('produk', 'ProdukController');
    Route::resource('transaksi', 'TransaksiController');
    Route::resource('promo', 'PromoController');
    Route::resource('banner', 'BannerController');
    Route::resource('layout', 'LayoutController');
});
