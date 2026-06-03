<form action="<?php echo e(route('products.index')); ?>" method="GET" class="search-box" id="filterForm">
    <?php if(request('danh_muc')): ?>
        <input type="hidden" name="danh_muc" value="<?php echo e(request('danh_muc')); ?>">
    <?php endif; ?>
    <?php if(request('gia')): ?>
        <input type="hidden" name="gia" value="<?php echo e(request('gia')); ?>">
    <?php endif; ?>
    <?php if(request('chat_lieu')): ?>
        <input type="hidden" name="chat_lieu" value="<?php echo e(request('chat_lieu')); ?>">
    <?php endif; ?>

    <input type="text" name="search" value="<?php echo e(request('search') ?? ''); ?>" placeholder="Tìm kiếm sản phẩm...">
    
    <button type="submit">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/search-bar.blade.php ENDPATH**/ ?>