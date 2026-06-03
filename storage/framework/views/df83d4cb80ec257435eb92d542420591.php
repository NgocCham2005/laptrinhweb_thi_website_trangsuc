<?php $__env->startSection('content'); ?>

<div class="auth-page-wrapper">
    
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đổi mật khẩu</h2>
            <p class="auth-custom-subtitle">Vui lòng nhập mật khẩu cũ và mật khẩu mới</p>

            
            <?php if(session('success')): ?>
                <div style="color: #28a745 !important; font-weight: bold; text-align: center; margin-bottom: 20px; font-size: 16px;">
                    <i class="fas fa-check-circle" style="color: #28a745 !important; margin-right: 5px;"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <?php if(session('error')): ?>
                <div class="auth-alert auth-alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <?php if($errors->any()): ?>
                <div class="auth-alert auth-alert-danger">
                    <ul class="auth-alert-list">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/change-password">
                <?php echo csrf_field(); ?>

                
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu cũ<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauCu" 
                        class="auth-input" 
                        placeholder="Nhập mật khẩu hiện tại" 
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
                        name="NhapLaiMatKhauMoi" 
                        class="auth-input" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                </div>

                
                <button type="submit" class="auth-btn-block">
                    Đổi mật khẩu
                </button>
                
                
                <div class="auth-custom-footer" style="margin-top: 25px;">
                    <a href="/profile" class="auth-gold-link">
                        <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/auth/change-password.blade.php ENDPATH**/ ?>