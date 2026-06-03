<?php $__env->startSection('content'); ?>
<div class="products-container">
    
    <aside class="category-sidebar">
        <h3 class="sidebar-title">Danh mục sản phẩm</h3>
        <div class="category-list">
            
            <a href="<?php echo e(route('products.index', ['danh_muc' => 'all'])); ?>" 
               class="category-item <?php echo e((empty($selectedCategory) || $selectedCategory == 'all') ? 'active' : ''); ?>">
                Tất cả danh mục
            </a>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('products.index', ['danh_muc' => $cat->MaDanhMuc])); ?>" 
                   class="category-item <?php echo e($selectedCategory == $cat->MaDanhMuc ? 'active' : ''); ?>">
                    <?php echo e($cat->TenDanhMuc); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </aside>

    <main class="products-main">
        
        <div class="products-filter-header">
            <span class="filter-title">Bộ lọc</span>

            <div class="filter-options-group">
                
                <select name="gia" form="filterForm" onchange="document.getElementById('filterForm').submit()" class="filter-select">
                    <option value="">Giá (Tất cả)</option>
                    <option value="duoi-5tr" <?php echo e(($priceFilter ?? '') === 'duoi-5tr' ? 'selected' : ''); ?>>Dưới 4.500.000đ</option>
                    <option value="5tr-10tr" <?php echo e(($priceFilter ?? '') === '5tr-10tr' ? 'selected' : ''); ?>>4.500.000đ - 10.000.000đ</option>
                    <option value="tren-10tr" <?php echo e(($priceFilter ?? '') === 'tren-10tr' ? 'selected' : ''); ?>>Trên 10.000.000đ</option>
                </select>

                <select name="chat_lieu" form="filterForm" onchange="document.getElementById('filterForm').submit()" class="filter-select">
                    <option value="all">Chất liệu (Tất cả)</option>
                    <option value="Bạc" <?php echo e(($materialFilter ?? '') === 'Bạc' ? 'selected' : ''); ?>>Bạc</option>
                    <option value="Vàng" <?php echo e(($materialFilter ?? '') === 'Vàng' ? 'selected' : ''); ?>>Vàng</option>
                </select>
                
            </div>

            <span class="products-count">Hiển thị <?php echo e($products->total()); ?> sản phẩm</span>
        </div>

        <div class="products-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="no-product-message">
                    <p>Hiện tại chưa có sản phẩm nào thuộc danh mục này.</p>
                </div>
            <?php endif; ?>
        </div>

          <?php if (isset($component)) { $__componentOriginal41032d87daf360242eb88dbda6c75ed1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41032d87daf360242eb88dbda6c75ed1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination','data' => ['paginator' => $products]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['paginator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($products)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41032d87daf360242eb88dbda6c75ed1)): ?>
<?php $attributes = $__attributesOriginal41032d87daf360242eb88dbda6c75ed1; ?>
<?php unset($__attributesOriginal41032d87daf360242eb88dbda6c75ed1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41032d87daf360242eb88dbda6c75ed1)): ?>
<?php $component = $__componentOriginal41032d87daf360242eb88dbda6c75ed1; ?>
<?php unset($__componentOriginal41032d87daf360242eb88dbda6c75ed1); ?>
<?php endif; ?>

    </main>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/products/index.blade.php ENDPATH**/ ?>