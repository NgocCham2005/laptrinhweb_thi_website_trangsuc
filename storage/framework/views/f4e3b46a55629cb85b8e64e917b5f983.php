<?php $__env->startSection('content'); ?>

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://file.hstatic.net/200000355853/file/15-bo-trang-suc-cuoi-vang-trang-sang-trong-h14.png');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng ký</h2>
            <p class="auth-custom-subtitle">Tạo tài khoản để trải nghiệm mua sắm</p>

            
            <?php if($errors->any()): ?>
                <div class="auth-alert auth-alert-danger">
                    <ul class="auth-alert-list">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/register" method="POST">
                <?php echo csrf_field(); ?>

                <div class="auth-form-grid">
                    
                    <div class="auth-group">
                        <label class="auth-label">Họ tên<span class="auth-required">*</span></label>
                        <input type="text" name="HoTen" class="auth-input" placeholder="Nhập họ tên" value="<?php echo e(old('HoTen')); ?>" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                        <input type="text" name="TenDangNhap" class="auth-input" placeholder="Nhập tên đăng nhập" value="<?php echo e(old('TenDangNhap')); ?>" required>
                    </div>

                    
                    <div class="auth-group">
                        <label class="auth-label">Email<span class="auth-required">*</span></label>
                        <input type="email" name="Email" class="auth-input" placeholder="Nhập Email" value="<?php echo e(old('Email')); ?>" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Số điện thoại<span class="auth-required">*</span></label>
                        <input type="text" name="SoDienThoai" class="auth-input" placeholder="Nhập số điện thoại" value="<?php echo e(old('SoDienThoai')); ?>" required>
                    </div>

                    
                    <div class="auth-group">
                        <label class="auth-label">Mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="MatKhau" class="auth-input" placeholder="Từ 6 ký tự, có chữ, số, ký tự đặc biệt" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Nhập lại mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="NhapLaiMatKhau" class="auth-input" placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>

                
                <button type="submit" class="auth-btn-block">
                    Đăng ký
                </button>
                
                
                <div class="auth-custom-footer">
                    <span>Đã có tài khoản? </span>
                    <a href="/login" class="auth-gold-link">Đăng nhập</a>
                </div>
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/auth/register.blade.php ENDPATH**/ ?>