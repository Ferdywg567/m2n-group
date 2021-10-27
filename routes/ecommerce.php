<?php

use Illuminate\Support\Facades\Route;

require 'admin.php';

Route::group(['namespace' => 'Ecommerce\Frontend'], function () {
    Route::resource('/', 'LandingPageController');

    Route::group(['as' => 'frontend.'], function () {
        //auth
        Route::group(['as' => 'auth.'], function () {
            Route::get('/login', 'AuthController@getLogin')->name('login');
            Route::get('/register', 'AuthController@getRegister')->name('register');
            Route::post('/register', 'AuthController@postRegister')->name('post.register');
            Route::post('/login', 'AuthController@postLogin')->name('post.login');
            Route::get('/logout', 'AuthController@logout')->name('logout');
        });

        Route::resource('product', 'ProductController');
    });

    Route::get('/detail', function () {
        return view("ecommerce.frontend.product.detail");
    });
    Route::get('/cart', function () {
        return view("ecommerce.frontend.cart.index");
    });
    Route::get('/user', function () {
        return view("ecommerce.frontend.user.index");
    });
    Route::get('/checkout', function () {
        return view("ecommerce.frontend.checkout.index");
    });
});
