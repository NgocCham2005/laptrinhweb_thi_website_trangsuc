<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/cart.css')); ?>">

<div class="cart-container">

    
    <div class="cart-header">
        <h1 class="cart-title">Giỏ hàng của tôi</h1>
        <?php if(count($chiTiet) > 0): ?>
            <span class="cart-count"><?php echo e(count($chiTiet)); ?> sản phẩm</span>
        <?php endif; ?>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <?php if(count($chiTiet) === 0): ?>
        <div class="cart-empty">
            <div class="cart-empty-icon">🛒</div>
            <h3>Giỏ hàng trống</h3>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
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
<?php $component->withAttributes(['variant' => 'primary']); ?>Tiếp tục mua sắm <?php echo $__env->renderComponent(); ?>
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
        <div class="cart-layout">

            
            <div class="cart-items">
                <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['headers' => ['', 'Mã SP', 'Tên sản phẩm', 'Đơn giá', 'Số lượng', 'Thành tiền', 'Thao tác']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['', 'Mã SP', 'Tên sản phẩm', 'Đơn giá', 'Số lượng', 'Thành tiền', 'Thao tác'])]); ?>

                    <?php $__currentLoopData = $chiTiet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="cart-row" id="row-<?php echo e($item->MaSanPham); ?>">

                        
                        <td class="td-check">
                            <label class="custom-check">
                                <input type="checkbox"
                                    class="sp-checkbox"
                                    data-ma="<?php echo e($item->MaSanPham); ?>"
                                    onchange="onCheckChange()">
                                <span class="checkmark"></span>
                            </label>
                        </td>

                        
                        <td><span class="item-code"><?php echo e($item->MaSanPham); ?></span></td>

                        
                        <td><span class="item-name"><?php echo e($item->sanPham->TenSanPham); ?></span></td>

                       
<td>
    <span class="item-price-plain">
        <?php echo e(number_format($item->sanPham->GiaBan, 0, ',', '.')); ?>đ
    </span>
</td>

                        
                        <td>
                            <div class="col-qty">
                                <button type="button" class="qty-btn"
                                    onclick="thayDoiSoLuong(this, -1)">−</button>
                                <input type="number"
                                    class="qty-input"
                                    value="<?php echo e($item->SoLuong); ?>"
                                    min="1"
                                    max="<?php echo e($item->sanPham->SoLuongTon); ?>"
                                    data-ma="<?php echo e($item->MaSanPham); ?>"
                                    data-gia="<?php echo e($item->sanPham->GiaBan); ?>"
                                    data-max="<?php echo e($item->sanPham->SoLuongTon); ?>"
                                    onchange="luuSoLuong(this)">
                                <button type="button" class="qty-btn"
                                    onclick="thayDoiSoLuong(this, 1)">+</button>
                                <span class="qty-saving" style="display:none;">⏳</span>
                            </div>
                        </td>

                        
                        <td>
                            <span class="item-total" data-don-gia="<?php echo e($item->sanPham->GiaBan); ?>">
                                <?php echo e(number_format($item->SoLuong * $item->sanPham->GiaBan, 0, ',', '.')); ?>đ
                            </span>
                        </td>

                        
                        <td>
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['size' => 'sm','variant' => 'danger','class' => 'btn-xoa-sp btn-xoa-hidden','dataMa' => ''.e($item->MaSanPham).'','dataTen' => ''.e($item->sanPham->TenSanPham).'','onclick' => 'openModal(\'modal-xoa-'.e($item->MaSanPham).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','variant' => 'danger','class' => 'btn-xoa-sp btn-xoa-hidden','data-ma' => ''.e($item->MaSanPham).'','data-ten' => ''.e($item->sanPham->TenSanPham).'','onclick' => 'openModal(\'modal-xoa-'.e($item->MaSanPham).'\')']); ?>
                                Xóa
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['id' => 'modal-xoa-'.e($item->MaSanPham).'','title' => 'Xác nhận xóa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modal-xoa-'.e($item->MaSanPham).'','title' => 'Xác nhận xóa']); ?>
                                <p>Bạn có chắc muốn xóa
                                    <strong><?php echo e($item->sanPham->TenSanPham); ?></strong>
                                    khỏi giỏ hàng?
                                </p>
                                 <?php $__env->slot('footer', null, []); ?> 
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','onclick' => 'closeModal(\'modal-xoa-'.e($item->MaSanPham).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','onclick' => 'closeModal(\'modal-xoa-'.e($item->MaSanPham).'\')']); ?>
                                        Hủy
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                    <form action="<?php echo e(route('cart.xoa')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="MaSanPham" value="<?php echo e($item->MaSanPham); ?>">
                                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','variant' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'danger']); ?>Xóa <?php echo $__env->renderComponent(); ?>
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
                                 <?php $__env->endSlot(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>

                
                <div class="cart-actions">
                    <label class="check-all-label">
                        <input type="checkbox" id="check-all" onchange="checkAll(this)">
                        <span>Chọn tất cả</span>
                    </label>
                    <div class="cart-actions-right">
                        <span class="selected-info" id="selected-info"></span>
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'danger','size' => 'sm','id' => 'btn-xoa-nhieu','disabled' => true,'onclick' => 'openModal(\'modal-xoa-nhieu\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','size' => 'sm','id' => 'btn-xoa-nhieu','disabled' => true,'onclick' => 'openModal(\'modal-xoa-nhieu\')']); ?>
                            Xóa đã chọn
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="cart-summary">
                <div class="summary-card">
                    <h3 class="summary-title">Tóm tắt đơn hàng</h3>

                    <div id="summary-details" style="display:none;">
                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span id="tong-tam-tinh"></span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row summary-total">
                        <span>Tổng cộng</span>
                        <span id="tong-cuoi" class="total-price"></span>
                    </div>
                    </div>

                    <p class="checkout-hint" id="checkout-hint"> Hãy chọn sản phẩm muốn mua</p>

                    
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','block' => true,'size' => 'lg','id' => 'btn-checkout','disabled' => true,'onclick' => 'diDenCheckout()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','block' => true,'size' => 'lg','id' => 'btn-checkout','disabled' => true,'onclick' => 'diDenCheckout()']); ?>
                        Đặt hàng ngay →
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>

                    <a href="<?php echo e(url('/san-pham')); ?>" class="cart-back-link">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'outline-navy','block' => true,'style' => 'margin-top:10px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'outline-navy','block' => true,'style' => 'margin-top:10px;']); ?>
                            ← Tiếp tục mua sắm
                         <?php echo $__env->renderComponent(); ?>
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
            </div>

        </div>

        
        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['id' => 'modal-xoa-nhieu','title' => 'Xác nhận xóa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modal-xoa-nhieu','title' => 'Xác nhận xóa']); ?>
            <p id="modal-xoa-nhieu-text">Bạn có chắc muốn xóa các sản phẩm đã chọn?</p>
             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','onclick' => 'closeModal(\'modal-xoa-nhieu\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','onclick' => 'closeModal(\'modal-xoa-nhieu\')']); ?>Hủy <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'danger','onclick' => 'xoaNhieu()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','onclick' => 'xoaNhieu()']); ?>Xóa <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

    <?php endif; ?>
</div>

<script>
const CSRF      = '<?php echo e(csrf_token()); ?>';
const URL_SUA   = '<?php echo e(route("cart.sua")); ?>';
const URL_XOA   = '<?php echo e(route("cart.xoa")); ?>';

// ── Checkbox logic ──
function onCheckChange() {
    const checkboxes = document.querySelectorAll('.sp-checkbox');
    const checked    = document.querySelectorAll('.sp-checkbox:checked');
    const soChon     = checked.length;

    // Cập nhật "chọn tất cả"
    const checkAll = document.getElementById('check-all');
    checkAll.indeterminate = soChon > 0 && soChon < checkboxes.length;
    checkAll.checked = soChon === checkboxes.length;

    // Hiện/ẩn nút Xóa từng dòng bằng class, không dùng disabled
    checkboxes.forEach(cb => {
        const row    = cb.closest("tr");
        const btnXoa = row.querySelector(".btn-xoa-sp");
        if (btnXoa) {
            if (cb.checked) {
                btnXoa.classList.remove("btn-xoa-hidden");
            } else {
                btnXoa.classList.add("btn-xoa-hidden");
            }
        }
    });

    // Bật/tắt nút Xóa đã chọn
    const btnXoaNhieu = document.getElementById("btn-xoa-nhieu");
    btnXoaNhieu.disabled = soChon === 0;

    // Bật/tắt nút Đặt hàng
    const btnCheckout = document.getElementById("btn-checkout");
    btnCheckout.disabled = soChon === 0;

    // Hint text
    const hint = document.getElementById("checkout-hint");
    hint.style.display = soChon === 0 ? "block" : "none";

    // Hiện/ẩn tóm tắt đơn hàng
    const summaryDetails = document.getElementById("summary-details");
    summaryDetails.style.display = soChon === 0 ? "none" : "block";

    // Info số đã chọn
    const info = document.getElementById("selected-info");
    info.textContent = soChon > 0 ? `Đã chọn ${soChon} sản phẩm` : "";

    // Tính lại tổng
    tinhLaiTong();
}

function checkAll(cb) {
    document.querySelectorAll('.sp-checkbox').forEach(function(el) {
        el.checked = cb.checked;
    });
    onCheckChange();
}

// ── Tổng tiền chỉ tính sản phẩm đã chọn ──
function tinhLaiTong() {
    let tong = 0;
    document.querySelectorAll('.sp-checkbox:checked').forEach(function(cb) {
        const row = cb.closest('tr');
        const gia = parseFloat(row.querySelector('.qty-input').dataset.gia);
        const sl  = parseInt(row.querySelector('.qty-input').value) || 1;
        tong += gia * sl;
    });

    // Nếu không chọn gì → hiện tổng toàn bộ
    const soChon = document.querySelectorAll('.sp-checkbox:checked').length;
    if (soChon === 0) {
        let tongTatCa = 0;
        document.querySelectorAll('.qty-input').forEach(function(inp) {
            tongTatCa += parseFloat(inp.dataset.gia) * (parseInt(inp.value) || 1);
        });
        tong = tongTatCa;
    }

    document.getElementById('tong-tam-tinh').textContent = formatVnd(tong);
    document.getElementById('tong-cuoi').textContent     = formatVnd(tong);
}

// ── Nút + / - ──
function thayDoiSoLuong(btn, delta) {
    const wrap  = btn.closest('.col-qty');
    const input = wrap.querySelector('.qty-input');
    const min   = parseInt(input.min) || 1;
    const max   = parseInt(input.max);
    let val     = parseInt(input.value) + delta;
    if (val < min) val = min;
    if (val > max) val = max;
    if (val === parseInt(input.value)) return;
    input.value = val;

    // Cập nhật thành tiền dòng đó
    const row = input.closest('tr');
    row.querySelector('.item-total').textContent =
        formatVnd(parseFloat(input.dataset.gia) * val);

    tinhLaiTong();
    luuSoLuong(input);
}

// ── AJAX lưu số lượng ──
function luuSoLuong(input) {
    const wrap   = input.closest('.col-qty');
    const saving = wrap.querySelector('.qty-saving');
    if (saving) saving.style.display = 'inline';
    input.disabled = true;

    fetch(URL_SUA, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ MaSanPham: input.dataset.ma, SoLuong: parseInt(input.value) })
    })
    .then(r => r.json())
    .then(data => { if (!data.success) showToast(data.message || 'Lỗi!', 'danger'); })
    .catch(() => showToast('Lỗi kết nối!', 'danger'))
    .finally(() => {
        if (saving) saving.style.display = 'none';
        input.disabled = false;
    });
}

// ── Xóa nhiều ──
function xoaNhieu() {
    const checked = document.querySelectorAll('.sp-checkbox:checked');
    const promises = Array.from(checked).map(cb => {
        return fetch(URL_XOA, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ MaSanPham: cb.dataset.ma })
        });
    });

    Promise.all(promises).then(() => {
        window.location.reload();
    });
}

// ── Đặt hàng chỉ SP đã chọn ──
function diDenCheckout() {
    const checked = document.querySelectorAll('.sp-checkbox:checked');
    if (checked.length === 0) return;

    // Tạo form POST gửi danh sách SP đã chọn
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?php echo e(route("order.checkout")); ?>';

    // CSRF
    const csrf = document.createElement('input');
    csrf.type  = 'hidden';
    csrf.name  = '_token';
    csrf.value = CSRF;
    form.appendChild(csrf);

    // Danh sách SP đã chọn
    checked.forEach(cb => {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'sp_chon[]';
        input.value = cb.dataset.ma;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function showToast(msg, type) {
    const t = document.createElement('div');
    t.className = 'alert alert-' + (type || 'success');
    t.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;min-width:260px;box-shadow:0 4px 16px rgba(0,0,0,.12);';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 3000);
}

function formatVnd(n) {
    return Math.round(n).toLocaleString('vi-VN') + 'đ';
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/cart/index.blade.php ENDPATH**/ ?>