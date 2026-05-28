<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
        '/categories',
        'admin.categories'
    )->name('categories');

    Route::view(
        '/products',
        'admin.products'
    )->name('products');


    Route::view(
        '/customers',
        'admin.customers'
    )->name('customers');


    Route::get('/banners', [BannerController::class, 'index'])
    ->name('banners');
    Route::get('/add-banner', [BannerController::class, 'create'])
    ->name('addBanner');
    Route::post('/add-banner', [BannerController::class, 'store'])
    ->name('storeBanner');
    Route::get('/edit-banner/{id}', [BannerController::class, 'edit'])
    ->name('editBanner');
    Route::post('/update-banner/{id}', [BannerController::class, 'update'])
    ->name('updateBanner');
    Route::delete('/delete-banner/{id}', [BannerController::class, 'destroy'])
    ->name('deleteBanner');

    Route::get('/vouchers', [VoucherController::class, 'index'])
    ->name('vouchers');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])
    ->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])
    ->name('vouchers.store');
    Route::get('/vouchers/{id}/edit', [VoucherController::class, 'edit'])
    ->name('vouchers.edit');
    Route::put('/vouchers/{id}', [VoucherController::class, 'update'])
    ->name('vouchers.update');
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy'])
    ->name('vouchers.destroy');

    Route::view(
        '/reviews',
        'admin.reviews'
    )->name('reviews');


    Route::view(
        '/reports',
        'admin.reports'
    )->name('reports');

});
// =====================
// GIỎ HÀNG & ĐẶT HÀNG (cần đăng nhập)
// =====================
// Route::middleware('auth')->group(function () {
Route::group([], function () {

    // Giỏ hàng
    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/gio-hang/them', [CartController::class, 'them'])->name('cart.them');
    Route::post('/gio-hang/sua', [CartController::class, 'sua'])->name('cart.sua');
    Route::post('/gio-hang/xoa', [CartController::class, 'xoa'])->name('cart.xoa');

    // Đặt hàng & thanh toán
    Route::get('/thanh-toan', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/thanh-toan/ap-voucher', [OrderController::class, 'apVoucher'])->name('order.apVoucher');
    Route::post('/thanh-toan/dat-hang', [OrderController::class, 'datHang'])->name('order.datHang');
    Route::get('/dat-hang-thanh-cong/{maDonHang}', [OrderController::class, 'success'])->name('order.success');

    // Mua ngay
    Route::post('/mua-ngay', [OrderController::class, 'muaNgay'])->name('order.muaNgay');

    Route::get('/don-hang', function () {
        return redirect('/')->with('info', 'Chức năng đang phát triển!');
    })->name('order.lichSu');

});