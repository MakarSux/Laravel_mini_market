<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.addToCart');

Route::get('/cart', [OrderController::class, 'cart'])->name('orders.cart');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::get('/orders', [OrderController::class, 'orders'])->name('orders.index');