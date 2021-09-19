<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Ecommerce\Frontend'],function () {
    Route::resource('/', 'LandingPageController');
    Route::resource('product', 'ProductController');
});
