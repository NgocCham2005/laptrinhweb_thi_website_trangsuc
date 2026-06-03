

<?php $__env->startSection('content'); ?>

<?php
    $orders = DB::table('Don_Hang')
        ->where('MaTaiKhoan', $user->MaTaiKhoan)
        ->orderBy('NgayDatHang', 'desc')
        ->get();
?>

<div class="ud-wrapper">

    
    <div class="ud-header">
        <div class="ud-header-left">
            <a href="/admin/customers" class="ud-back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
                Quay lại
            </a>
            <div>
                <h2 class="ud-title">Chi tiết khách hàng</h2>
                <p class="ud-subtitle"><?php echo e($user->MaTaiKhoan); ?></p>
            </div>
        </div>
        <span class="ud-status-badge <?php echo e($user->TrangThai == 1 ? 'ud-status-active' : 'ud-status-locked'); ?>">
            <?php echo e($user->TrangThai == 1 ? 'Hoạt động' : 'Đã khóa'); ?>

        </span>
    </div>

    <div class="ud-body">

        
        <div class="ud-card ud-info-card">
            <div class="ud-card-head">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Thông tin tài khoản
            </div>
            <div class="ud-card-body">
                <div class="ud-avatar">
                    <?php echo e(mb_substr($user->HoTen, 0, 1)); ?>

                </div>
                <div class="ud-info-grid">
                    <div class="ud-info-item">
                        <span class="ud-info-label">Mã tài khoản</span>
                        <span class="ud-info-value ud-mono"><?php echo e($user->MaTaiKhoan); ?></span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Họ tên</span>
                        <span class="ud-info-value"><?php echo e($user->HoTen); ?></span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Tên đăng nhập</span>
                        <span class="ud-info-value ud-mono"><?php echo e($user->TenDangNhap); ?></span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Email</span>
                        <span class="ud-info-value"><?php echo e($user->Email); ?></span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Số điện thoại</span>
                        <span class="ud-info-value"><?php echo e($user->SoDienThoai); ?></span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Địa chỉ</span>
                        <span class="ud-info-value"><?php echo e($user->DiaChi); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="ud-card ud-orders-card">
            <div class="ud-card-head">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="2"/>
                </svg>
                Lịch sử đơn hàng
                <span class="ud-order-count"><?php echo e(count($orders)); ?> đơn</span>
            </div>
            <div class="ud-card-body ud-no-pad">
                <?php if(count($orders) > 0): ?>
                <table class="ud-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Người nhận</th>
                            <th>Địa chỉ giao</th>
                            <th>PTTT</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="ud-mono ud-order-id"><?php echo e($order->MaDonHang); ?></span></td>
                            <td><?php echo e(\Carbon\Carbon::parse($order->NgayDatHang)->format('d/m/Y')); ?></td>
                            <td><?php echo e($order->TenNguoiNhan); ?></td>
                            <td><?php echo e($order->DiaChiGiaoHang); ?></td>
                            <td><?php echo e($order->PTTT); ?></td>
                            <td>
                                <?php
                                    $trangThai = $order->TrangThai;
                                    $labelMap = [
                                        0 => ['text' => 'Chờ xác nhận', 'class' => 'ud-badge-pending'],
                                        1 => ['text' => 'Đang xử lý',   'class' => 'ud-badge-processing'],
                                        2 => ['text' => 'Đang giao',    'class' => 'ud-badge-shipping'],
                                        3 => ['text' => 'Đã giao',      'class' => 'ud-badge-done'],
                                        4 => ['text' => 'Đã hủy',       'class' => 'ud-badge-cancel'],
                                    ];
                                    $info = $labelMap[$trangThai] ?? ['text' => 'Không rõ', 'class' => 'ud-badge-pending'];
                                ?>
                                <span class="ud-badge <?php echo e($info['class']); ?>"><?php echo e($info['text']); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="ud-empty">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v4M12 16h.01"/>
                    </svg>
                    <p>Khách hàng chưa có đơn hàng nào</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/admin/users/user-detail.blade.php ENDPATH**/ ?>