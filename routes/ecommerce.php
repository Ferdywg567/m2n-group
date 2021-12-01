<?php

use Illuminate\Support\Facades\Route;

require 'admin.php';

Route::group(['namespace' => 'Ecommerce\Frontend'], function () {

    Route::group(['as' => 'landingpage.'], function () {
        Route::resource('/', 'LandingPageController');
    });
    Route::group(['as' => 'frontend.'], function () {
        //auth
        Route::group(['as' => 'auth.'], function () {
            Route::get('/login', 'AuthController@getLogin')->name('login');
            Route::get('/register', 'AuthController@getRegister')->name('register');
            Route::post('/register', 'AuthController@postRegister')->name('post.register');
            Route::post('/login', 'AuthController@postLogin')->name('post.login');
            Route::get('/logout', 'AuthController@logout')->name('logout');
            Route::get('/auth/redirect', 'AuthController@redirectToProvider')->name('google');
            Route::get('/auth/callback', 'AuthController@handleProviderCallback');
        });


        Route::group(['middleware' => ['role:ecommerce', 'auth'], 'prefix' => 'ecommerce'], function () {

            Route::group(['prefix' => 'alamat', 'as' => 'alamat.'], function () {
                Route::post('/update_alamat', 'AlamatController@update_alamat')->name('update_alamat');
                Route::get('/get_alamat', 'AlamatController@getAlamat')->name('get_alamat');
            });

            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::post('/update_password', 'UserController@UpdatePassword')->name('update_password');
                Route::post('/update_foto', 'UserController@UpdateFoto')->name('update_foto');
                Route::group(['prefix' => 'pembelian', 'as' => 'pembelian.'], function () {
                    Route::post('/update_selesai', 'PembelianController@update_selesai')->name('update_selesai');
                });
                Route::resource('pembelian', 'PembelianController');
            });
            Route::group(['prefix' => 'keranjang', 'as' => 'keranjang.'], function () {
                Route::post('/update_checkbox', 'KeranjangController@update_checkbox')->name('update_checkbox');
                Route::post('/update_jumlah', 'KeranjangController@update_jumlah')->name('update_jumlah');
                Route::get('/hapus/{id}', 'KeranjangController@hapus')->name('hapus');
                Route::get('/showdatasidebar', 'KeranjangController@showDataSidebar')->name('showdatasidebar');
            });
            Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
                Route::post('/beli_langsung', 'CheckoutController@beli_langsung')->name('beli_langsung');
                Route::get('/success/{token_checkout}', 'CheckoutController@get_checkout_success')->name('success');
            });
            Route::resource('alamat', 'AlamatController');
            Route::resource('keranjang', 'KeranjangController');
            Route::resource('checkout', 'CheckoutController');
            Route::resource('user', 'UserController');
        });
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/caribykategori', 'ProductController@CariKategori')->name('kategori');
            Route::get('/get_cari', 'ProductController@cari')->name('get_cari');
            Route::get('/cari', 'ProductController@showCari')->name('show_cari');
        });
        Route::resource('product', 'ProductController');
    });

    Route::get('/detail', function () {
        return view("ecommerce.frontend.product.detail");
    });
    // Route::get('/cart', function () {
    //     return view("ecommerce.frontend.cart.index");
    // });
    Route::get('/produk', function () {
        return view("ecommerce.frontend.product.index");
    });
    // Route::get('/checkout', function () {
    //     return view("ecommerce.frontend.checkout.index");
    // });
});
