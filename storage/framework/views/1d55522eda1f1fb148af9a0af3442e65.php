<?php $__env->startSection('content'); ?>

<div class="auth-page-wrapper">
    
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Quên mật khẩu</h2>
            <p class="auth-custom-subtitle">Nhập email và mật khẩu mới</p>

            
            <?php if(session('success')): ?>
                <div style="color: #28a745 !important; font-weight: bold; text-align: center; margin-bottom: 20px; font-size: 16px;">
                    <i class="fas fa-check-circle" style="color: #28a745 !important; margin-right: 5px;"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <?php if($errors->any()): ?>
                <div class="auth-alert auth-alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="margin: 0 0 4px 0;"><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <form action="/forgot-password" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="auth-group">
                    <label class="auth-label">Email<span class="auth-required">*</span></label>
                    <input 
                        type="email" 
                        name="Email" 
                        class="auth-input" 
                        placeholder="Nhập Email" 
                        value="<?php echo e(old('Email')); ?>" 
                        required
                    >
                </div>

                
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu mới<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauMoi" 
                        class="auth-input" 
                        placeholder="Nhập mật khẩu mới" 
                        required
                    >
                </div>

                
                <div class="auth-group">
                    <label class="auth-label">Nhập lại mật khẩu mới<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="NhapLaiMatKhau" 
                        class="auth-input" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                </div>

                
                <button type="submit" class="auth-btn-block">
                    Đặt lại mật khẩu
                </button>
                
                
                <div class="auth-custom-footer" style="margin-top: 25px;">
                    <a href="/login" class="auth-gold-link">
                        <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Quay lại Đăng nhập
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>