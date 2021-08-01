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
    Route::resource('cuci', 'CuciController');
    Route::resource('retur', 'ReturController');
    Route::resource('rekapitulasi', 'RekapitulasiController');
    Route::resource('sampah', 'SampahController');
    Route::resource('perbaikan', 'PerbaikanController');
});
