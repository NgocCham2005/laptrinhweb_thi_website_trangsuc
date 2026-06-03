<header class="header">
    <div class="top-header" id="topHeader">
        <div class="logo">
            <a href="/">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="">
            </a>
        </div>
        <?php if (isset($component)) { $__componentOriginal61542037d001e2034791c9aff5866543 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61542037d001e2034791c9aff5866543 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61542037d001e2034791c9aff5866543)): ?>
<?php $attributes = $__attributesOriginal61542037d001e2034791c9aff5866543; ?>
<?php unset($__attributesOriginal61542037d001e2034791c9aff5866543); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61542037d001e2034791c9aff5866543)): ?>
<?php $component = $__componentOriginal61542037d001e2034791c9aff5866543; ?>
<?php unset($__componentOriginal61542037d001e2034791c9aff5866543); ?>
<?php endif; ?>
        <div class="header-right">
            <a href="<?php echo e(route('cart.index')); ?>" class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                Giỏ hàng
            </a>

            <?php if(auth()->guard()->check()): ?>
                <a href="/profile" class="user-icon" title="<?php echo e(Auth::user()->HoTen); ?>">
                    <i class="fa-solid fa-circle-user"></i>
                </a>
            <?php else: ?>
                <a href="/login">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="sticky-header" id="stickyHeader">
    <div class="navbar">
        <a href="/" class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">
            Trang chủ
        </a>
        <a href="/products" class="<?php echo e(request()->is('products') ? 'active' : ''); ?>">
            Sản phẩm
        </a>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('order.lichSu')); ?>" class="<?php echo e(request()->is('don-hang*') ? 'active' : ''); ?>">
                Đơn hàng
            </a>
        <?php else: ?>
            <a href="/login" class="<?php echo e(request()->is('don-hang*') ? 'active' : ''); ?>">
                Đơn hàng
            </a>
        <?php endif; ?>
    </div>
    <div class="policy-bar">
        <div>SẢN PHẨM CHẤT LƯỢNG</div>
        <div>HỖ TRỢ 24/7</div>
        <div>ƯU ĐÃI VẬN CHUYỂN</div>
    </div>
</div><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/partials/header.blade.php ENDPATH**/ ?>