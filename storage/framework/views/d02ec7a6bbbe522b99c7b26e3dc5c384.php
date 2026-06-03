<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name'        => '',
    'label'       => null,
    'type'        => 'text',
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
    'disabled'    => false,
    'hint'        => null,
    'icon'        => null,
    'rows'        => 4,
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
    'name'        => '',
    'label'       => null,
    'type'        => 'text',
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
    'disabled'    => false,
    'hint'        => null,
    'icon'        => null,
    'rows'        => 4,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $hasError   = $errors->has($name);
    $stateClass = $hasError ? 'is-invalid' : '';
    $inputId    = 'input-' . $name;
?>

<div class="form-group">
    <?php if($label): ?>
        <label for="<?php echo e($inputId); ?>" class="form-label">
            <?php echo e($label); ?>

            <?php if($required): ?> <span class="required">*</span> <?php endif; ?>
        </label>
    <?php endif; ?>

    <div class="<?php echo e($icon ? 'input-group' : ''); ?>">
        <?php if($icon): ?>
            <span class="input-icon"><?php echo e($icon); ?></span>
        <?php endif; ?>

        <?php if($type === 'textarea'): ?>
            <textarea
                id="<?php echo e($inputId); ?>"
                name="<?php echo e($name); ?>"
                rows="<?php echo e($rows); ?>"
                placeholder="<?php echo e($placeholder); ?>"
                <?php echo e($required ? 'required' : ''); ?>

                <?php echo e($disabled ? 'disabled' : ''); ?>

                <?php echo e($attributes->merge(['class' => "form-control {$stateClass}"])); ?>

            ><?php echo e(old($name, $value)); ?></textarea>

        <?php elseif($type === 'select'): ?>
            <select
                id="<?php echo e($inputId); ?>"
                name="<?php echo e($name); ?>"
                <?php echo e($required ? 'required' : ''); ?>

                <?php echo e($disabled ? 'disabled' : ''); ?>

                <?php echo e($attributes->merge(['class' => "form-control {$stateClass}"])); ?>

            >
                <?php echo e($slot); ?>

            </select>

        <?php else: ?>
            <input
                id="<?php echo e($inputId); ?>"
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>"
                value="<?php echo e(old($name, $value)); ?>"
                placeholder="<?php echo e($placeholder); ?>"
                <?php echo e($required ? 'required' : ''); ?>

                <?php echo e($disabled ? 'disabled' : ''); ?>

                <?php echo e($attributes->merge(['class' => "form-control {$stateClass}"])); ?>

            >
        <?php endif; ?>
    </div>

    <?php if($hasError): ?>
        <div class="form-error"><?php echo e($errors->first($name)); ?></div>
    <?php elseif($hint): ?>
        <div class="form-hint"><?php echo e($hint); ?></div>
    <?php endif; ?>
</div><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/input.blade.php ENDPATH**/ ?>