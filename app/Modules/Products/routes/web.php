<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\Controllers\ProductController;

// wajib menggunakan middleware 'web' agar session & auth terbaca
Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

Route::get('/products/{product}/reduce-stock/{quantity}', [ProductController::class, 'reduceStock'])
    ->name('products.reduceStock');

Route::resource('products', ProductController::class);  
