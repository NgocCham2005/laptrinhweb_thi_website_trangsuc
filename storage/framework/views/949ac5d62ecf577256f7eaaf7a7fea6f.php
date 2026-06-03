<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type'     => 'button',
    'variant'  => 'primary',
    'size'     => 'md',
    'block'    => false,
    'disabled' => false,
    'icon'     => null,
]));

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

foreach (array_filter(([
    'type'     => 'button',
    'variant'  => 'primary',
    'size'     => 'md',
    'block'    => false,
    'disabled' => false,
    'icon'     => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $sizeClass  = $size === 'sm' ? 'btn-sm' : ($size === 'lg' ? 'btn-lg' : ($size === 'xl' ? 'btn-xl' : ''));
    $blockClass = $block ? 'btn-block' : '';
?>

<button
    type="<?php echo e($type); ?>"
    <?php echo e($disabled ? 'disabled' : ''); ?>

    <?php echo e($attributes->merge(['class' => "btn btn-{$variant} {$sizeClass} {$blockClass}"])); ?>

>
    <?php if($icon): ?>
        <span class="btn-icon-left"><?php echo e($icon); ?></span>
    <?php endif; ?>
    <?php echo e($slot); ?>

</button><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/button.blade.php ENDPATH**/ ?>