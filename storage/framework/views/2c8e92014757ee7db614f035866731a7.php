<?php $__env->startSection('content'); ?>

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://apj.vn/wp-content/uploads/2024/09/MTDB0513-bo-vang-1.jpg');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng nhập</h2>
            <p class="auth-custom-subtitle">Chào mừng quay trở lại website trang sức</p>

            
            <?php if(session('success')): ?>
                <div class="auth-alert auth-alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <?php if(session('error')): ?>
                <div class="auth-alert auth-alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="auth-group">
                    <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                    <input
                        type="text"
                        name="TenDangNhap"
                        class="auth-input"
                        placeholder="Nhập tên đăng nhập"
                        value="<?php echo e(old('TenDangNhap')); ?>"
                        required
                    >
                </div>

                
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu<span class="auth-required">*</span></label>
                    <input
                        type="password"
                        name="MatKhau"
                        class="auth-input"
                        placeholder="Nhập mật khẩu"
                        required
                    >
                </div>

                
                <button type="submit" class="auth-btn-block">
                    Đăng nhập
                </button>
                
                
                <div class="auth-forgot-right">
                    <a href="/forgot-password" class="auth-gold-link">Quên mật khẩu?</a>
                </div>
                
                
                <div class="auth-custom-footer">
                    <span>Chưa có tài khoản? </span>
                    <a href="/register" class="auth-gold-link">Đăng ký ngay</a>
                </div>
                
<div class="auth-custom-footer" style="margin-top: 12px;">
    <a href="/" class="auth-gold-link">
        <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Quay lại trang chủ
    </a>
</div>
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/auth/login.blade.php ENDPATH**/ ?>