<aside class="sidebar">

<div class="logo">

<img
src="<?php echo e(asset('images/logo.png')); ?>"
alt="Logo">

</div>

<nav>

<a href="<?php echo e(route('admin.orders')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.orders*')
? 'active'
: ''); ?>">

<i class="fa-solid fa-file-invoice"></i>

<span>Đơn hàng</span>

</a>

<a href="<?php echo e(route('admin.categories')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.categories')
? 'active'
: ''); ?>">

<i class="fa-solid fa-layer-group"></i>

<span>Danh mục sản phẩm</span>

</a>

<a href="<?php echo e(route('admin.products')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.products')
? 'active'
: ''); ?>">

<i class="fa-solid fa-gem"></i>

<span>Sản phẩm</span>

</a>



<a href="<?php echo e(route('admin.customers')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.customers')
? 'active'
: ''); ?>">

<i class="fa-solid fa-users"></i>

<span>Khách hàng</span>

</a>



<a href="<?php echo e(route('admin.banners')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.banners')
? 'active'
: ''); ?>">

<i class="fa-solid fa-image"></i>

<span>Banner</span>

</a>



<a href="<?php echo e(route('admin.vouchers')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.vouchers')
? 'active'
: ''); ?>">

<i class="fa-solid fa-ticket"></i>

<span>Voucher</span>

</a>



<a href="<?php echo e(route('admin.reviews')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.reviews')
? 'active'
: ''); ?>">

<i class="fa-solid fa-star"></i>

<span>Đánh giá</span>

</a>



<a href="<?php echo e(route('admin.reports.index')); ?>"
class="menu-item
<?php echo e(request()->routeIs('admin.reports.index')
? 'active'
: ''); ?>">

<i class="fa-solid fa-chart-line"></i>

<span>Báo cáo</span>

</a>

</nav>

</aside><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>