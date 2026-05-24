<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home.index');
})->name('home');


Route::get('/products', function () {
    return view('products.index');
})->name('products');

#Test route admin

Route::prefix('admin')
->name('admin.')
// ->middleware(['auth','admin']) // bật sau
->group(function(){

    // vào admin mặc định hiện đơn hàng

    Route::redirect(
        '/',
        '/admin/orders'
    );


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

    Route::get('/vouchers', [VoucherController::class, 'index'])
    ->name('vouchers');

    Route::get('/vouchers/create', [VoucherController::class, 'create'])
    ->name('vouchers.create');

    Route::post('/vouchers', [VoucherController::class, 'store'])
    ->name('vouchers.store');

    Route::view(
        '/reviews',
        'admin.reviews'
    )->name('reviews');


    Route::view(
        '/reports',
        'admin.reports'
    )->name('reports');

});
