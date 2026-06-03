<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'paginator'
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
    'paginator'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($paginator->hasPages()): ?>

<div class="pagination-wrapper">

<nav>

<ul class="pagination">


<?php if($paginator->onFirstPage()): ?>

<li class="page-item disabled">

<span class="page-link">
‹
</span>

</li>

<?php else: ?>

<li class="page-item">

<a
class="page-link"
href="<?php echo e($paginator->previousPageUrl()); ?>"
>

‹

</a>

</li>

<?php endif; ?>



<?php $__currentLoopData = $paginator->getUrlRange(1, $paginator->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<li class="page-item
<?php echo e($page == $paginator->currentPage()
? 'active'
: ''); ?>">

<a
class="page-link"
href="<?php echo e($url); ?>"
>

<?php echo e($page); ?>


</a>

</li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php if($paginator->hasMorePages()): ?>

<li class="page-item">

<a
class="page-link"
href="<?php echo e($paginator->nextPageUrl()); ?>"
>

›

</a>

</li>

<?php else: ?>

<li class="page-item disabled">

<span class="page-link">
›
</span>

</li>

<?php endif; ?>

</ul>

</nav>

</div>

<?php endif; ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/components/pagination.blade.php ENDPATH**/ ?>