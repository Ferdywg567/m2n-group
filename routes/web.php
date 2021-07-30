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


// Auth::routes();


Route::group(['prefix' => 'garment', 'namespace' => 'Backend', 'as' => 'backend.'], function () {

    Route::get('login', 'AuthController@getLogin')->name('getlogin');
    Route::post('login', 'AuthController@login')->name('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'production', 'namespace' => 'Backend', 'middleware' => 'AuthBackend'], function () {
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
