<?php $__env->startSection('content'); ?>


<link rel="stylesheet" href="<?php echo e(asset('css/checkout.css')); ?>">

<div class="checkout-wrap">

    
    <h1 class="checkout-heading">
    🛒 Thanh toán
</h1>

    
    <div class="checkout-steps">
        <div class="step active">
            <span class="step-num">1</span>
            <span>Thanh toán</span>
        </div>
        <div class="step-sep"></div>
        <div class="step">
            <span class="step-num">2</span>
            <span>Xác nhận</span>
        </div>
    </div>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger" style="margin-bottom:20px;">
            ⚠️ <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('order.datHang')); ?>" method="POST" id="form-order">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="NguonDat"   value="<?php echo e($nguonDat); ?>">
        <input type="hidden" name="MaVoucher"  id="input-ma-voucher">
        <input type="hidden" name="GiaTriGiam" id="input-gia-tri-giam" value="0">

        <div class="checkout-grid">

            
            <div>

                
                <div class="checkout-card">
                    <div class="checkout-card-title">📦 Thông tin giao hàng</div>

                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'TenNguoiNhan','label' => 'Họ tên người nhận','placeholder' => 'Nguyễn Văn A','icon' => '👤','required' => true,'value' => old('TenNguoiNhan')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'TenNguoiNhan','label' => 'Họ tên người nhận','placeholder' => 'Nguyễn Văn A','icon' => '👤','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('TenNguoiNhan'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'SoDienThoai','label' => 'Số điện thoại','type' => 'tel','placeholder' => '0912 345 678','icon' => '📞','required' => true,'value' => old('SoDienThoai')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'SoDienThoai','label' => 'Số điện thoại','type' => 'tel','placeholder' => '0912 345 678','icon' => '📞','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('SoDienThoai'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'DiaChiGiaoHang','label' => 'Địa chỉ giao hàng','type' => 'textarea','placeholder' => 'Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành...','required' => true,'rows' => 3,'value' => old('DiaChiGiaoHang')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'DiaChiGiaoHang','label' => 'Địa chỉ giao hàng','type' => 'textarea','placeholder' => 'Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành...','required' => true,'rows' => 3,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('DiaChiGiaoHang'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                
                <div class="checkout-card">
                    <div class="checkout-card-title">💳 Phương thức thanh toán</div>

                    <div class="pttt-group">
                        <label class="pttt-option active" id="opt-cod">
                            <input type="radio" name="PTTT" value="COD" checked>
                            <span class="icon">🚚</span>
                            <span class="lbl">Tiền mặt (COD)</span>
                        </label>
                        <label class="pttt-option" id="opt-ck">
                            <input type="radio" name="PTTT" value="CK">
                            <span class="icon">🏦</span>
                            <span class="lbl">Chuyển khoản</span>
                        </label>
                    </div>

                    <?php $__errorArgs = ['PTTT'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="form-error" style="margin-top:8px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="ck-box" id="ck-info">
                        <span class="ck-label">Thông tin tài khoản</span>
                        <div>
                            🏦 <strong>Ngân hàng:</strong> Vietcombank<br>
                            📋 <strong>Số tài khoản:</strong> 1234567890<br>
                            👤 <strong>Chủ tài khoản:</strong> NGUYEN VAN A<br>
                            📝 <strong>Nội dung CK:</strong>
                            <span id="ck-noidung" style="color:var(--gold);font-weight:700">[Tên] + [SĐT]</span>
                        </div>
                        <div class="ck-qr">
                            <img
                                src="https://img.vietqr.io/image/VCB-1234567890-compact2.png?amount=0&addInfo=DatHang&accountName=NGUYEN+VAN+A"
                                alt="QR chuyển khoản"
                                id="ck-qr-img"
                                onerror="this.style.display='none'"
                            >
                            <p>Quét mã QR để chuyển khoản nhanh</p>
                        </div>
                        <div class="ck-warn">
                            ⚠️ Đơn hàng sẽ được xác nhận sau khi admin nhận được tiền.
                        </div>
                    </div>
                </div>

            </div>

            
            <div>
                <div class="checkout-card">
                    <div class="checkout-card-title">🧾 Đơn hàng của bạn</div>

                    
                    <?php $__currentLoopData = $chiTiet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-item">
                            <div class="order-item-info">
                                <div class="order-item-name"><?php echo e($item->sanPham->TenSanPham); ?></div>
                                <div class="order-item-qty">x<?php echo e($item->SoLuong); ?></div>
                            </div>
                            <div class="order-item-price">
                                <?php echo e(number_format($item->SoLuong * $item->sanPham->GiaBan)); ?>đ
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($vouchers->count() > 0): ?>
                        <div class="voucher-wrap">
                            <span class="voucher-label-text">🎟️ Chọn voucher giảm giá</span>

                            <div class="voucher-selector" id="voucher-selector"
                                 onclick="toggleVoucherDropdown()">
                                <span id="voucher-label" style="color:var(--gray-400)">
                                    -- Chọn voucher --
                                </span>
                                <span class="voucher-chevron" id="voucher-chevron">▼</span>
                            </div>

                            <div class="voucher-dropdown" id="voucher-dropdown">

                                <div class="vd-item none-opt" onclick="selectVoucher(null)">
                                    Không dùng voucher
                                </div>

                                <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $valid = $tongTien >= (float) $v->DieuKien;
                                        $giam  = (int) $v->GiaTriGiamToiDa;
                                    ?>

                                    <div class="vd-item <?php echo e($valid ? 'clickable' : 'disabled'); ?>"
                                        <?php if($valid): ?>
                                            onclick="selectVoucher('<?php echo e($v->MaVoucher); ?>', <?php echo e($giam); ?>, '<?php echo e(addslashes($v->TenVoucher ?? $v->MaVoucher)); ?>')"
                                        <?php endif; ?>
                                    >
                                        <div class="vd-row">
                                            <div>
                                                <span class="vd-code <?php echo e($valid ? '' : 'dim'); ?>"><?php echo e($v->MaVoucher); ?></span>
                                                <?php if(!empty($v->TenVoucher)): ?>
                                                    <span class="vd-name"><?php echo e($v->TenVoucher); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <span class="vd-saving <?php echo e($valid ? '' : 'dim'); ?>">
                                                -<?php echo e(number_format($giam)); ?>đ
                                            </span>
                                        </div>
                                        <div class="vd-note <?php echo e($valid ? 'ok' : ''); ?>">
                                            <?php if($valid): ?>
                                                ✅ Áp dụng được cho đơn này
                                            <?php else: ?>
                                                ⛔ Đơn tối thiểu <?php echo e(number_format($v->DieuKien)); ?>đ
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                            <div class="voucher-msg" id="voucher-msg"></div>
                        </div>
                    <?php else: ?>
                        <p class="no-voucher">Không có voucher khả dụng</p>
                    <?php endif; ?>

                    
                    <hr class="summary-divider">

                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span><?php echo e(number_format($tongTien)); ?>đ</span>
                    </div>

                    <div class="summary-row discount" id="row-giam" style="display:none;">
                        <span>🎟️ Giảm giá (voucher)</span>
                        <span id="txt-giam">-0đ</span>
                    </div>

                    <div class="summary-row free">
                        <span>Phí giao hàng</span>
                        <span>0đ</span>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng cộng</span>
                        <span class="summary-total-price" id="txt-tong">
                            <?php echo e(number_format($tongTien)); ?>đ
                        </span>
                    </div>

                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','variant' => 'primary','block' => true,'size' => 'lg','id' => 'btn-order','class' => 'btn-checkout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','block' => true,'size' => 'lg','id' => 'btn-order','class' => 'btn-checkout']); ?>
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

                </div>
            </div>

        </div>
    </form>

</div>

<script>
const tongTienGoc = <?php echo e($tongTien); ?>;

// Scroll tới lỗi đầu tiên nếu có
document.addEventListener("DOMContentLoaded", function() {
    const firstError = document.querySelector(".form-error, .is-invalid");
    if (firstError) {
        firstError.closest(".form-group, .checkout-card")?.scrollIntoView({ behavior: "smooth", block: "center" });
    }
});
let voucherOpen   = false;

/* ── Phương thức thanh toán ── */
document.querySelectorAll('input[name="PTTT"]').forEach(radio => {
    radio.addEventListener('change', function () {
        document.querySelectorAll('.pttt-option').forEach(el => el.classList.remove('active'));
        this.closest('.pttt-option').classList.add('active');
        document.getElementById('ck-info').style.display = this.value === 'CK' ? 'block' : 'none';
    });
});

/* ── Cập nhật nội dung CK realtime ── */
function capNhatNoiDungCK() {
    const ten = document.querySelector('input[name="TenNguoiNhan"]')?.value.trim() || '';
    const sdt = document.querySelector('input[name="SoDienThoai"]')?.value.trim()  || '';
    const nd  = [ten, sdt].filter(Boolean).join(' - ') || '[Tên] + [SĐT]';
    const el  = document.getElementById('ck-noidung');
    if (el) el.textContent = nd;
}
document.querySelector('input[name="TenNguoiNhan"]')?.addEventListener('input', capNhatNoiDungCK);
document.querySelector('input[name="SoDienThoai"]')?.addEventListener('input', capNhatNoiDungCK);

/* ── Voucher dropdown ── */
function toggleVoucherDropdown() {
    voucherOpen = !voucherOpen;
    document.getElementById('voucher-dropdown').classList.toggle('open', voucherOpen);
    document.getElementById('voucher-selector').classList.toggle('open', voucherOpen);
    document.getElementById('voucher-chevron').classList.toggle('open', voucherOpen);
}

function selectVoucher(maVoucher, giamGia, tenVoucher) {
    voucherOpen = false;
    document.getElementById('voucher-dropdown').classList.remove('open');
    document.getElementById('voucher-selector').classList.remove('open');
    document.getElementById('voucher-chevron').classList.remove('open');

    const label = document.getElementById('voucher-label');
    const msg   = document.getElementById('voucher-msg');

    if (!maVoucher) {
        label.textContent = '-- Chọn voucher --';
        label.style.color = 'var(--gray-400)';
        document.getElementById('input-ma-voucher').value   = '';
        document.getElementById('input-gia-tri-giam').value = '0';
        document.getElementById('row-giam').style.display   = 'none';
        document.getElementById('txt-tong').textContent     = fmt(tongTienGoc);
        msg.textContent = '';
        msg.className   = 'voucher-msg';
        return;
    }

    label.textContent = maVoucher + (tenVoucher ? ' — ' + tenVoucher : '');
    label.style.color = 'var(--gold)';
    document.getElementById('input-ma-voucher').value   = maVoucher;
    document.getElementById('input-gia-tri-giam').value = giamGia;
    document.getElementById('row-giam').style.display   = 'flex';
    document.getElementById('txt-giam').textContent     = '-' + fmt(giamGia);
    document.getElementById('txt-tong').textContent     = fmt(tongTienGoc - giamGia);
    msg.textContent = '✅ Đã áp dụng voucher ' + maVoucher;
    msg.className   = 'voucher-msg ok';
}

function fmt(n) {
    return new Intl.NumberFormat('vi-VN').format(n) + 'đ';
}

/* ── Đóng dropdown khi click ngoài ── */
document.addEventListener('click', function (e) {
    const sel = document.getElementById('voucher-selector');
    const dd  = document.getElementById('voucher-dropdown');
    if (!sel || !dd) return;
    if (!sel.contains(e.target) && !dd.contains(e.target) && voucherOpen) {
        voucherOpen = false;
        dd.classList.remove('open');
        sel.classList.remove('open');
        document.getElementById('voucher-chevron').classList.remove('open');
    }
});

/* ── Chống submit double-click ── */
document.getElementById('form-order').addEventListener('submit', function () {
    const btn = document.getElementById('btn-order');
    if (btn) {
        btn.disabled    = true;
        btn.textContent = 'Đang xử lý...';
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/order/checkout.blade.php ENDPATH**/ ?>