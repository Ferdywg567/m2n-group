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
    Route::resource('produk', 'ProdukController');
    //profil user
    Route::group(['prefix' => 'user'], function () {
        Route::post('/update_password','UserController@update_password');
    });
    Route::resource('user', 'UserController');
});
