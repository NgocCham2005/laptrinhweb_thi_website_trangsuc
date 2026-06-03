<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width">

<title>

<?php echo $__env->yieldContent('title'); ?>

</title>

<link rel="stylesheet"
href="<?php echo e(asset('css/admin.css')); ?>">

<link rel="stylesheet"
href="<?php echo e(asset('css/form.css')); ?>">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="admin-layout">

<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="admin-main">

<?php echo $__env->make('partials.admin-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="admin-content">

<?php echo $__env->yieldContent('content'); ?>

</div>

</div>

</div>

</body>

</html><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/layouts/admin.blade.php ENDPATH**/ ?>