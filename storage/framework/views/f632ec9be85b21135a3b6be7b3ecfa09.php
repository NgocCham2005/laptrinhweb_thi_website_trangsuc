<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="product-card">
    <a href="<?php echo e(route('products.detail', $product->MaSanPham)); ?>" style="text-decoration: none; display: block; width: 100%;">
        <div class="product-img-container">
            <?php if($product->images && $product->images->first()): ?>
                <img src="<?php echo e(asset('images/products/' . $product->images->first()->DuongDan)); ?>" alt="<?php echo e($product->TenSanPham); ?>">
            <?php else: ?>
                <img src="<?php echo e(asset('images/default-jewelry.png')); ?>" alt="<?php echo e($product->TenSanPham); ?>">
            <?php endif; ?>
        </div>
    </a>

    <div class="product-content">
        <a href="<?php echo e(route('products.detail', $product->MaSanPham)); ?>" style="text-decoration: none; color: inherit; display: block;">
            <h3 class="product-title"><?php echo e($product->TenSanPham); ?></h3>
        </a>
        
        <p class="product-material">Chất liệu: <?php echo e($product->ChatLieu); ?></p>
        
        <?php if (isset($component)) { $__componentOriginal314d489042885418ede5c9b13226585a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal314d489042885418ede5c9b13226585a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.price-tag','data' => ['gia' => $product->GiaBan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('price-tag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['gia' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->GiaBan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal314d489042885418ede5c9b13226585a)): ?>
<?php $attributes = $__attributesOriginal314d489042885418ede5c9b13226585a; ?>
<?php unset($__attributesOriginal314d489042885418ede5c9b13226585a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal314d489042885418ede5c9b13226585a)): ?>
<?php $component = $__componentOriginal314d489042885418ede5c9b13226585a; ?>
<?php unset($__componentOriginal314d489042885418ede5c9b13226585a); ?>
<?php endif; ?>
        
        <div class="product-actions">
            <form action="<?php echo e(route('cart.them')); ?>" method="POST" style="flex:1">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="MaSanPham" value="<?php echo e($product->MaSanPham); ?>">
                <input type="hidden" name="SoLuong" value="1">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','variant' => 'secondary','block' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'secondary','block' => true]); ?>Thêm vào giỏ <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </form>

            <form action="<?php echo e(route('order.muaNgay')); ?>" method="POST" style="flex:1">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="MaSanPham" value="<?php echo e($product->MaSanPham); ?>">
                <input type="hidden" name="SoLuong" value="1">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','block' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','block' => true]); ?>Mua ngay <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </form>
        </div>
    </div>
</div><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/product-card.blade.php ENDPATH**/ ?>