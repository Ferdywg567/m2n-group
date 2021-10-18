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

Route::group(['prefix' => 'garment', 'as' => 'backend.', 'namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('getlogin');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'warehouse', 'namespace' => 'Backend', 'middleware' => ['role:warehouse', 'auth'], 'as' => 'warehouse.'], function () {
    Route::resource('dashboard', 'DashboardController');

    Route::group(['prefix' => 'print', 'as' => 'print.'], function () {
        Route::get('/cetak', 'PrintController@cetak')->name('export');
    });
    Route::resource('print', 'PrintController');
    Route::group(['namespace' => 'Warehouse'], function () {
        Route::group(['prefix' => 'finishing', 'as' => 'finishing.'], function () {
            Route::post('/cetak', 'FinishingController@cetakPdf')->name('cetak');
            Route::get('/getdataprint', 'FinishingController@getDataPrint')->name('getdataprint');
            Route::get('/getdatarekap', 'FinishingController@getDataRekap')->name('getdatarekap');
            Route::get('/getdatafinishing', 'FinishingController@getDataFinish')->name('getdatafinish');
        });

        Route::group(['prefix' => 'warehouse', 'as' => 'warehouse.'], function () {
            Route::post('/cetak', 'WarehouseController@cetakPdf')->name('cetak');
            Route::get('/getdataprint', 'WarehouseController@getDataPrint')->name('getdataprint');
        });

        Route::group(['prefix' => 'retur', 'as' => 'retur.'], function () {
            Route::post('/cetak', 'ReturController@cetakPdf')->name('cetak');
            Route::get('/getdataprint', 'ReturController@getDataPrint')->name('getdataprint');
        });
        Route::group(['prefix' => 'rekapitulasi', 'as' => 'rekapitulasi.'], function () {
            Route::post('/cetak', 'RekapitulasiController@cetakPdf')->name('cetak');
            Route::get('/getdataprint', 'RekapitulasiController@getDataPrint')->name('getdataprint');
            Route::get('/getdatarekapitulasi', 'RekapitulasiController@getDataRekapitulasi')->name('getdata');
        });

        Route::resource('finishing', 'FinishingController');
        Route::resource('warehouse', 'WarehouseController');
        Route::resource('retur', 'ReturController');
        Route::resource('rekapitulasi', 'RekapitulasiController');
    });
});

Route::group(['namespace' => 'Backend', 'middleware' => ['role:production|warehouse', 'auth']], function () {
    Route::get('notification-read','DashboardController@read')->name('notification');
    Route::get('notification-read-klik','DashboardController@readklik')->name('notification.readklik');
});


Route::group(['prefix' => 'production', 'namespace' => 'Backend', 'middleware' => ['role:production', 'auth']], function () {

    Route::resource('dashboard', 'DashboardController');

    Route::group(['prefix' => 'bahan', 'as' => 'bahan.'], function () {
        Route::post('/cetak', 'BahanController@cetakPdf')->name('cetak');
        Route::get('/getdatabahan', 'BahanController@getDataBahan')->name('getdata');
        Route::get('/getdatasku', 'BahanController@getDataSKU')->name('getdatasku');
        Route::get('/getdataprint', 'BahanController@getDataPrint')->name('getdataprint');
    });
    Route::resource('bahan', 'BahanController');

    Route::group(['prefix' => 'potong', 'as' => 'potong.'], function () {
        Route::post('/cetak', 'PotongController@cetakPdf')->name('cetak');
        Route::get('/getdatapotong', 'PotongController@getDataPotong')->name('getdata');
        Route::get('/getdataprint', 'PotongController@getDataPrint')->name('getdataprint');
        Route::get('/update_status', 'PotongController@update_status')->name('update_status');
    });
    Route::resource('potong', 'PotongController');


    Route::group(['prefix' => 'jahit', 'as' => 'jahit.'], function () {
        Route::post('/cetak', 'JahitController@cetakPdf')->name('cetak');
        Route::get('/getdataprint', 'JahitController@getDataPrint')->name('getdataprint');
        Route::get('/getdatajahit', 'JahitController@getDataJahit')->name('getdata');
        Route::get('/pembayaran/{id}','JahitController@pembayaranVendor')->name('pembayaran');
        Route::get('/update_status', 'JahitController@update_status')->name('update_status');
        Route::put('/pembayaran/update/{id}','JahitController@pembayaranVendorUpdate')->name('pembayaran.update');
    });
    Route::resource('jahit', 'JahitController');

    Route::group(['prefix' => 'cuci', 'as' => 'cuci.'], function () {
        Route::post('/cetak', 'CuciController@cetakPdf')->name('cetak');
        Route::get('/getdataprint', 'CuciController@getDataPrint')->name('getdataprint');
        Route::get('/getdatacuci', 'CuciController@getDataCuci')->name('getdata');
        Route::get('/update_status', 'CuciController@update_status')->name('update_status');
        Route::get('/pembayaran/{id}','CuciController@pembayaranVendor')->name('pembayaran');
        Route::put('/pembayaran/update/{id}','CuciController@pembayaranVendorUpdate')->name('pembayaran.update');
    });



    Route::group(['prefix' => 'rekapitulasi', 'as' => 'rekapitulasi.'], function () {
        Route::post('/cetak', 'RekapitulasiController@cetakPdf')->name('cetak');
        Route::get('/getdatarekapitulasi', 'RekapitulasiController@getDataCuci')->name('getdata');
    });

    Route::group(['prefix' => 'print', 'as' => 'print.'], function () {
        Route::get('/cetak', 'PrintController@cetak')->name('export');
    });

    Route::group(['prefix' => 'retur', 'as' => 'retur.'], function () {
        Route::post('/cetak', 'ReturController@cetakPdf')->name('cetak');
        Route::get('/getdataprint', 'ReturController@getDataPrint')->name('getdataprint');
    });

    Route::group(['prefix' => 'perbaikan', 'as' => 'perbaikan.'], function () {
        Route::post('/cetak', 'PerbaikanController@cetakPdf')->name('cetak');
    });

    Route::group(['prefix' => 'sampah', 'as' => 'sampah.'], function () {
        Route::post('/cetak', 'SampahController@cetakPdf')->name('cetak');
    });
    Route::group(['prefix' => 'pembayaran', 'as' => 'pembayaran.'], function () {
        Route::get('/cetak', 'PembayaranController@cetakPdf')->name('cetak');
    });
    Route::group(['prefix' => 'kategori', 'as' => 'kategori.'], function () {
        Route::get('/getkategori', 'KategoriController@getKategori')->name('getkategori');
        Route::get('/getsubkategori', 'KategoriController@getSubKategori')->name('getSubKategori');
        Route::get('/getsubkategoridetail', 'KategoriController@getDetailSubKategori')->name('getDetailSubKategori');
    });

    Route::resource('kategori', 'KategoriController');
    Route::resource('pembayaran', 'PembayaranController');
    Route::resource('sku', 'SkuController');
    Route::resource('cuci', 'CuciController');
    Route::resource('retur', 'ReturController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('sampah', 'SampahController');
    Route::resource('perbaikan', 'PerbaikanController');
    Route::resource('print', 'PrintController');
});
