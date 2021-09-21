<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Ecommerce\Frontend'],function () {
    Route::resource('/', 'LandingPageController');
    Route::resource('product', 'ProductController');
    Route::get('/detail', function(){
        return view("ecommerce.frontend.product.detail");
    });
    Route::get('/cart', function(){
        return view("ecommerce.frontend.cart.index");
    });
    Route::get('/user', function(){
        return view("ecommerce.frontend.user.index");
    });
});
