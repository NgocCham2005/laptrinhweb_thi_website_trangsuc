<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Luminous Jewelry</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/component.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/variables.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/form.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/user-layout.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('css/component.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('css/product.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('css/product-detail.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('css/form.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo e(asset('js/slider.js')); ?>"></script>
</head>

<body>

     <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 

    <main>
       <?php echo $__env->yieldContent('content'); ?> 
    </main>

   <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 
   

</body>

</html><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/layouts/app.blade.php ENDPATH**/ ?>