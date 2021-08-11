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
    Route::group(['namespace' => 'Warehouse'], function () {
        Route::group(['prefix' => 'finishing', 'as' => 'finishing.'], function () {
            Route::get('/getdatarekap', 'FinishingController@getDataRekap')->name('getdatarekap');
            Route::get('/getdatafinishing', 'FinishingController@getDataFinish')->name('getdatafinish');
        });
        Route::resource('finishing', 'FinishingController');
        Route::resource('warehouse', 'WarehouseController');
    });
});

Route::group(['prefix' => 'production', 'namespace' => 'Backend', 'middleware' => ['role:production', 'auth']], function () {
    Route::resource('dashboard', 'DashboardController');

    Route::group(['prefix' => 'bahan', 'as' => 'bahan.'], function () {
        Route::get('/getdatabahan', 'BahanController@getDataBahan')->name('getdata');
    });
    Route::resource('bahan', 'BahanController');

    Route::group(['prefix' => 'potong', 'as' => 'potong.'], function () {
        Route::get('/getdatapotong', 'PotongController@getDataPotong')->name('getdata');
    });
    Route::resource('potong', 'PotongController');


    Route::group(['prefix' => 'jahit', 'as' => 'jahit.'], function () {
        Route::get('/getdatajahit', 'JahitController@getDataJahit')->name('getdata');
    });
    Route::resource('jahit', 'JahitController');

    Route::group(['prefix' => 'cuci', 'as' => 'cuci.'], function () {
        Route::get('/getdatacuci', 'CuciController@getDataCuci')->name('getdata');
    });


    Route::group(['prefix' => 'rekapitulasi', 'as' => 'rekapitulasi.'], function () {
        Route::get('/getdatarekapitulasi', 'RekapitulasiController@getDataCuci')->name('getdata');
    });
    Route::resource('cuci', 'CuciController');
    Route::resource('retur', 'ReturController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('sampah', 'SampahController');
    Route::resource('perbaikan', 'PerbaikanController');
    Route::resource('print', 'PrintController');
});
