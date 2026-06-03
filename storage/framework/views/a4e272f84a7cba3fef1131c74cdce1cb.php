<?php
    $banners = \App\Models\Banner::where('TrangThai', 1)
        ->orderBy('MaBanner')
        ->take(5)
        ->get();

    $slideBanners = $banners->take(3);
    $topBanner = $banners->get(3);
    $bottomBanner = $banners->get(4);
?>

<section class="home-banner-layout">

    
    <div class="banner-main">

        <?php $__currentLoopData = $slideBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img
                src="<?php echo e(asset('images/banners/' . $banner->HinhAnh)); ?>"
                alt="<?php echo e($banner->TenBanner); ?>"
                class="banner-slide <?php echo e($index === 0 ? 'active' : ''); ?>"
            >
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    
    <div class="banner-side">

        <?php if($topBanner): ?>
            <div class="banner-small">
                <img
                    src="<?php echo e(asset('images/banners/' . $topBanner->HinhAnh)); ?>"
                    alt="<?php echo e($topBanner->TenBanner); ?>"
                >
            </div>
        <?php endif; ?>

        <?php if($bottomBanner): ?>
            <div class="banner-small">
                <img
                    src="<?php echo e(asset('images/banners/' . $bottomBanner->HinhAnh)); ?>"
                    alt="<?php echo e($bottomBanner->TenBanner); ?>"
                >
            </div>
        <?php endif; ?>

    </div>

</section><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/banner.blade.php ENDPATH**/ ?>