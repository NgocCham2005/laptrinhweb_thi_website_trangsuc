<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id'    => 'modal',
    'title' => '',
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
    'id'    => 'modal',
    'title' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="modal-backdrop" id="<?php echo e($id); ?>" onclick="handleBackdropClick(event, '<?php echo e($id); ?>')">
    <div class="modal" role="dialog" aria-modal="true">

        <div class="modal-header">
            <h3 class="modal-title"><?php echo e($title); ?></h3>
            <button type="button" class="modal-close" onclick="closeModal('<?php echo e($id); ?>')">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <?php echo e($slot); ?>

        </div>

        <?php if(isset($footer)): ?>
            <div class="modal-footer">
                <?php echo e($footer); ?>

            </div>
        <?php endif; ?>

    </div>
</div>

<?php if (! $__env->hasRenderedOnce('5ee661c4-e3bc-4fb8-aece-ca91eee08bcf')): $__env->markAsRenderedOnce('5ee661c4-e3bc-4fb8-aece-ca91eee08bcf'); ?>
<script>
function openModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('open');
    document.body.style.overflow = '';
}

function handleBackdropClick(event, id) {
    if (event.target.classList.contains('modal-backdrop')) {
        closeModal(id);
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-backdrop.open').forEach(function(el) {
            closeModal(el.id);
        });
    }
});
</script>
<?php endif; ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/modal.blade.php ENDPATH**/ ?>