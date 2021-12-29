<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'API'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});


Route::group(['middleware' => ['assign.guard:api', 'jwt.auth'], 'namespace' => 'API'], function () {
    //beranda
    Route::resource('kategori', 'KategoriController');
    Route::resource('sub_kategori', 'SubKategoriController');
    Route::resource('detail_sub_kategori', 'DetailSubKategoriController');
    Route::resource('produk', 'ProdukController');
    Route::resource('banner', 'BannerController');
    //profil user
    Route::group(['prefix' => 'user'], function () {
        Route::post('/update_password','UserController@update_password');
    });

    //cart
    Route::group(['prefix' => 'keranjang'], function () {
        Route::post('/update_qty','KeranjangController@update_qty');
        Route::post('/check','KeranjangController@check');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::post('/upload_bukti','CheckoutController@upload_bukti');
    });

    Route::resource('user', 'UserController');
    Route::resource('favorit', 'FavoritController');
    Route::resource('cari', 'CariController');
    Route::resource('keranjang', 'KeranjangController');
    Route::resource('bank', 'BankController');
    Route::resource('alamat', 'AlamatController');
    Route::resource('checkout', 'CheckoutController');
    Route::resource('admin', 'AdminController');
    Route::resource('transaksi', 'TransaksiController');
});
