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





Route::group(['prefix' => 'garment', 'as' => 'backend.','namespace' => 'Auth'], function () {
    Route::get('login','LoginController@showLoginForm')->name('getlogin');
    Route::post('login','LoginController@login')->name('login');
    Route::post('logout','LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'production', 'namespace' => 'Backend','middleware' => ['role:production','auth']], function () {
    Route::resource('dashboard', 'DashboardController');

    Route::group(['prefix' => 'bahan', 'as' => 'bahan.'], function () {
        Route::get('/getdatabahan', 'BahanController@getDataBahan')->name('getdata');
    });
    Route::resource('bahan', 'BahanController');

    Route::group(['prefix' => 'potong', 'as' => 'potong.'], function () {
        Route::get('/getdatapotong', 'PotongController@getDataPotong')->name('getdata');
    });
    Route::resource('potong', 'PotongController');


    Route::resource('jahit', 'JahitController');
});
