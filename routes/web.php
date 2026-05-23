<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home.index');
})->name('home');


Route::get('/products', function () {
    return view('products.index');
})->name('products');

/*
#Test route admin
Route::redirect('/','/admin/orders');

Route::prefix('admin')
->name('admin.')
->group(function(){

Route::view(
'/orders',
'admin.orders'
)->name('orders');


Route::view(
'/products',
'admin.products'
)->name('products');


Route::view(
'/customers',
'admin.customers'
)->name('customers');


Route::view(
'/banners',
'admin.banners'
)->name('banners');


Route::view(
'/vouchers',
'admin.vouchers'
)->name('vouchers');


Route::view(
'/reviews',
'admin.reviews'
)->name('reviews');


Route::view(
'/reports',
'admin.reports'
)->name('reports');

});*/
