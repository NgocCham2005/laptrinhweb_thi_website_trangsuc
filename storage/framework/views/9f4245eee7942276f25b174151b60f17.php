<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/manage_user_orders.css')); ?>">

<div class="lich-su-wrap">

    <h1 class="lich-su-heading">📦 Lịch sử đơn hàng</h1>

    
    <?php if($donHangs->isEmpty()): ?>
        <div class="lich-su-empty">
            <span class="lich-su-empty-icon">🛍️</span>
            <h3>Chưa có đơn hàng nào</h3>
            <p>Bạn chưa thực hiện đơn hàng nào. Hãy khám phá bộ sưu tập của chúng tôi!</p>
            <a href="<?php echo e(url('/san-pham')); ?>">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary']); ?>Mua sắm ngay <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </a>
        </div>

    
    <?php else: ?>
        <div class="don-hang-list">
            <?php $__currentLoopData = $donHangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $tamTinh  = $dh->chiTietDonHang->sum(fn($i) => $i->SoLuong * $i->DonGia);
                    $giam     = $dh->GiaTriApDung ?? 0;
                    $tongCuoi = $tamTinh - $giam;
                    $spHien   = $dh->chiTietDonHang->take(2);
                    $conLai   = $dh->chiTietDonHang->count() - 2;
                ?>

                <div class="don-hang-card">

                    
                    <div class="don-hang-header">
                        <div>
                            <div class="don-hang-ma"><?php echo e($dh->MaDonHang); ?></div>
                            <div class="don-hang-ngay">
                                <?php echo e(\Carbon\Carbon::parse($dh->NgayDatHang)->format('d/m/Y H:i')); ?>

                            </div>
                        </div>
                        <div class="don-hang-header-right">
                            <span class="pttt-badge <?php echo e($dh->PTTT === 'COD' ? 'pttt-cod' : 'pttt-ck'); ?>">
                                <?php echo e($dh->PTTT === 'COD' ? '🚚 COD' : '🏦 Chuyển khoản'); ?>

                            </span>
                           <?php
    $trangThaiMap = [
        0 => ['class' => 'status-0', 'label' => 'Chờ xác nhận'],
        1 => ['class' => 'status-1', 'label' => 'Đã xác nhận'],
        2 => ['class' => 'status-2', 'label' => 'Đang giao'],
        3 => ['class' => 'status-3', 'label' => 'Hoàn thành'],
    ];
    $tt = $trangThaiMap[$dh->TrangThai] ?? $trangThaiMap[0];
?>
<span class="status-badge <?php echo e($tt['class']); ?>"><?php echo e($tt['label']); ?></span>
                        </div>
                    </div>

                    
                    <div class="don-hang-body">

                        
                        <div class="don-hang-sp-list">
                            <?php $__currentLoopData = $spHien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="don-hang-sp-item">
                                    <span class="sp-dot"></span>
                                    <span class="don-hang-sp-name">
                                        <?php echo e($item->sanPham->TenSanPham ?? 'Sản phẩm không còn tồn tại'); ?>

                                    </span>
                                    <span class="don-hang-sp-qty">x<?php echo e($item->SoLuong); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($conLai > 0): ?>
                                <div class="don-hang-sp-more">+ <?php echo e($conLai); ?> sản phẩm khác...</div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="don-hang-right">
                            <div>
                                <div class="don-hang-tong-label">Tổng cộng</div>
                                <div class="don-hang-tong-gia"><?php echo e(number_format($tongCuoi)); ?>đ</div>
                            </div>
                            <div style="display:flex; flex-direction:column; gap:8px; align-items:flex-end;">
                                <a href="<?php echo e(route('order.chiTiet', $dh->MaDonHang)); ?>">
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'outline-navy','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'outline-navy','size' => 'sm']); ?>Xem chi tiết → <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                </a>
                                <?php if($dh->TrangThai == 3): ?>
                                    <div style="display:flex; flex-wrap:wrap; gap:6px; justify-content:flex-end;">
                                        <?php $__currentLoopData = $dh->chiTietDonHang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->sanPham): ?>
                                                <a href="<?php echo e(route('review.create', [$item->MaSanPham, $dh->MaDonHang])); ?>">
                                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'outline-navy','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'outline-navy','size' => 'sm']); ?>⭐ <?php echo e(Str::limit($item->sanPham->TenSanPham, 20)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="lich-su-pagination">
            <?php echo e($donHangs->links()); ?>

        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/order/manage_user_orders.blade.php ENDPATH**/ ?>