<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminVoucherController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\AdminReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home.index');
})->name('home');


// Route::get('/products', function () {
//     return view('products.index');
// })->name('products');
Route::get('/product/{id}',[ProductController::class, 'show'])->name('products.detail');

//review cho sản phẩm trong đơn hàng

Route::get('/review/create/{product}/{order}',[ReviewController::class, 'create'])->name('review.create');
Route::post('/review/store',[ReviewController::class, 'store'])->name('review.store');

Route::get('/products', [ListProductController::class, 'index'])->name('products.index');
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

    Route::get(
    '/orders',
    [AdminOrderController::class,'index']
    )->name('orders');

    Route::get(
    '/orders/{id}',
    [AdminOrderController::class,'show']
    )->name('orders.show');

    Route::put(
    '/orders/{id}',
    [AdminOrderController::class,'update']
    )->name('orders.update');

    // Route::view(
    //     '/categories',
    //     'admin.categories'
    // )->name('categories');

    // Route::view(
    //     '/products',
    //     'admin.products'
    // )->name('products');


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

    Route::get('/vouchers', [AdminVoucherController::class, 'index'])
    ->name('vouchers');
    Route::get('/vouchers/create', [AdminVoucherController::class, 'create'])
    ->name('vouchers.create');
    Route::post('/vouchers', [AdminVoucherController::class, 'store'])
    ->name('vouchers.store');
    Route::get('/vouchers/{id}/edit', [AdminVoucherController::class, 'edit'])
    ->name('vouchers.edit');
    Route::put('/vouchers/{id}', [AdminVoucherController::class, 'update'])
    ->name('vouchers.update');
    Route::delete('/vouchers/{id}', [AdminVoucherController::class, 'destroy'])
    ->name('vouchers.destroy');

    Route::get('/reviews', [AdminReviewController::class, 'index'])
    ->name('reviews');
    Route::post('/reviews/reply/{id}',[AdminReviewController::class, 'reply'])
    ->name('replyReview');
    Route::put('/reviews/hide/{id}',[AdminReviewController::class, 'hide'])
    ->name('hideReview');
    Route::put('/reviews/display/{id}',[AdminReviewController::class, 'display'])
    ->name('displayReview');
    Route::delete('/reviews/delete/{id}',[AdminReviewController::class, 'destroy'])
    ->name('deleteReview');

    Route::get(
        '/reports',
        [AdminReportController::class, 'index']
    )->name('reports.index');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('createCategory');
    Route::get('/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('editCategory');
    Route::post('/categories/store', [AdminCategoryController::class, 'store'])->name('storeCategory');
    Route::put('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('updateCategory');
    Route::delete('/categories/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('deleteCategory');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('addProduct');
    Route::post('/products/store', [AdminProductController::class, 'store'])->name('storeProduct');
    Route::get('/products/edit/{id}', [AdminProductController::class, 'edit'])->name('editProduct');
    Route::put('/products/update/{id}', [AdminProductController::class, 'update'])->name('updateProduct');
    Route::delete('/products/delete/{id}', [AdminProductController::class, 'destroy'])->name('deleteProduct');
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