<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="profile-body-wrapper">
    <div class="profile-layout">

        
        <div class="profile-sidebar">
            <div class="profile-avatar-circle">
                <?php echo e(substr($user->HoTen ?? 'U', 0, 1)); ?>

            </div>
            <div class="profile-sidebar-name"><?php echo e($user->HoTen); ?></div>
            <div class="profile-sidebar-email"><?php echo e($user->Email); ?></div>
            
            
            <a href="/" class="profile-sidebar-home">
                <i class="fas fa-house" style="margin-right: 6px;"></i> Trang chủ
            </a>
            
            <div class="profile-sidebar-divider"></div>
            
            <button id="btn-tab-view" onclick="showView('view')" class="profile-sidebar-btn active">
                <i class="fas fa-user"></i> Thông tin cá nhân
            </button>
            <button id="btn-tab-edit" onclick="showView('edit')" class="profile-sidebar-btn">
                <i class="fas fa-user-edit"></i> Cập nhật dữ liệu
            </button>
            <a href="/change-password" class="profile-sidebar-btn">
                <i class="fas fa-key"></i> Đổi mật khẩu
            </a>

            
            <button onclick="openLogoutModal()" class="profile-sidebar-btn profile-sidebar-btn-logout">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </button>
        </div>

        
        <div class="profile-main">

            <?php if(session('success')): ?>
                <div class="profile-success-text">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="profile-main-title">
                <i class="far fa-user"></i> Thông tin tài khoản
            </div>

            
            <div id="profile-view">
                <div class="profile-info-row">
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-user"></i> Họ tên</span>
                        <span class="profile-value"><?php echo e($user->HoTen); ?></span>
                    </div>
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-envelope"></i> Email</span>
                        <span class="profile-value"><?php echo e($user->Email); ?></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-phone"></i> Số điện thoại</span>
                        <span class="profile-value"><?php echo e($user->SoDienThoai ?? 'Chưa cập nhật'); ?></span>
                    </div>
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-map-marker-alt"></i> Địa chỉ</span>
                        <span class="profile-value"><?php echo e($user->DiaChi ?? 'Chưa cập nhật'); ?></span>
                    </div>
                </div>
            </div>

            
            <div id="profile-edit" style="display:none;">
                <form action="/profile/update" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="profile-edit-grid">
                        <div class="profile-edit-item">
                            <label class="profile-label">Họ tên</label>
                            <input type="text" name="HoTen" class="profile-input" value="<?php echo e($user->HoTen); ?>">
                            <?php $__errorArgs = ['HoTen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="profile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Số điện thoại</label>
                            <input type="text" name="SoDienThoai" class="profile-input" value="<?php echo e($user->SoDienThoai); ?>">
                            <?php $__errorArgs = ['SoDienThoai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="profile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Email</label>
                            <input type="email" name="Email" class="profile-input" value="<?php echo e($user->Email); ?>">
                            <?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="profile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Địa chỉ</label>
                            <input type="text" name="DiaChi" class="profile-input" value="<?php echo e($user->DiaChi); ?>">
                            <?php $__errorArgs = ['DiaChi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="profile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div class="profile-edit-actions">
                        <button type="button" onclick="showView('view')" class="btn-action-cancel">Hủy</button>
                        <button type="submit" class="btn-action-save">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div id="logout-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div class="logout-modal">
        <div class="logout-modal-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h5 class="logout-modal-title">Xác nhận đăng xuất</h5>
        <p class="logout-modal-text">Bạn có chắc chắn muốn đăng xuất tài khoản?</p>
        <div class="logout-modal-actions">
            <button onclick="closeLogoutModal()" class="btn-action-cancel" style="padding: 10px 24px;">Hủy bỏ</button>
            <a href="/logout" class="btn-action-save" style="background-color: #dc3545; border-color: #dc3545; text-decoration: none; padding: 10px 24px;">Đăng xuất</a>
        </div>
    </div>
</div>

<script>
function showView(name) {
    document.getElementById('profile-view').style.display = name === 'view' ? 'block' : 'none';
    document.getElementById('profile-edit').style.display = name === 'edit' ? 'block' : 'none';
    
    const tabView = document.getElementById('btn-tab-view');
    const tabEdit = document.getElementById('btn-tab-edit');
    
    if(name === 'view') {
        tabView.classList.add('active');
        tabEdit.classList.remove('active');
    } else {
        tabView.classList.remove('active');
        tabEdit.classList.add('active');
    }
}
function openLogoutModal() {
    document.getElementById('logout-overlay').style.display = 'flex';
}
function closeLogoutModal() {
    document.getElementById('logout-overlay').style.display = 'none';
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/profile/profile.blade.php ENDPATH**/ ?>