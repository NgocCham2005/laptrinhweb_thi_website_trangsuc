@extends('layouts.auth')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-body-wrapper">
    <div class="profile-layout">

        {{-- SIDEBAR TRÁI KHÍT MÉP - FULL CHIỀU CAO HỆ THỐNG --}}
        <div class="profile-sidebar">
            <div class="profile-avatar-circle">
                {{ substr($user->HoTen ?? 'U', 0, 1) }}
            </div>
            <div class="profile-sidebar-name">{{ $user->HoTen }}</div>
            <div class="profile-sidebar-email">{{ $user->Email }}</div>
            
            {{-- Nút trang chủ --}}
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

            {{-- Đăng xuất: màu trắng, hover → nền đỏ --}}
            <button onclick="openLogoutModal()" class="profile-sidebar-btn profile-sidebar-btn-logout">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </button>
        </div>

        {{-- NỘI DUNG PHẢI --}}
        <div class="profile-main">

            @if(session('success'))
                <div class="profile-success-text">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="profile-main-title">
                <i class="far fa-user"></i> Thông tin tài khoản
            </div>

            {{-- HIỂN THỊ THÔNG TIN --}}
            <div id="profile-view">
                <div class="profile-info-row">
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-user"></i> Họ tên</span>
                        <span class="profile-value">{{ $user->HoTen }}</span>
                    </div>
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-envelope"></i> Email</span>
                        <span class="profile-value">{{ $user->Email }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-phone"></i> Số điện thoại</span>
                        <span class="profile-value">{{ $user->SoDienThoai ?? 'Chưa cập nhật' }}</span>
                    </div>
                    <div class="profile-info-block">
                        <span class="profile-label"><i class="fas fa-map-marker-alt"></i> Địa chỉ</span>
                        <span class="profile-value">{{ $user->DiaChi ?? 'Chưa cập nhật' }}</span>
                    </div>
                </div>
            </div>

            {{-- FORM SỬA ĐỔI --}}
            <div id="profile-edit" style="display:none;">
                <form action="/profile/update" method="POST">
                    @csrf
                    <div class="profile-edit-grid">
                        <div class="profile-edit-item">
                            <label class="profile-label">Họ tên</label>
                            <input type="text" name="HoTen" class="profile-input" value="{{ $user->HoTen }}">
                            @error('HoTen')<span class="profile-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Số điện thoại</label>
                            <input type="text" name="SoDienThoai" class="profile-input" value="{{ $user->SoDienThoai }}">
                            @error('SoDienThoai')<span class="profile-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Email</label>
                            <input type="email" name="Email" class="profile-input" value="{{ $user->Email }}">
                            @error('Email')<span class="profile-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="profile-edit-item">
                            <label class="profile-label">Địa chỉ</label>
                            <input type="text" name="DiaChi" class="profile-input" value="{{ $user->DiaChi }}">
                            @error('DiaChi')<span class="profile-error">{{ $message }}</span>@enderror
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

{{-- POPUP ĐĂNG XUẤT --}}
<div id="logout-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div class="logout-modal">
        <div class="logout-modal-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h5 class="logout-modal-title">Xác nhận đăng xuất</h5>
        <p class="logout-modal-text">Bạn có chắc chắn muốn đăng xuất tài khoản?</p>
        <div class="logout-modal-actions">
            <button onclick="closeLogoutModal()" class="btn-action-cancel" style="padding: 10px 24px;">Hủy bỏ</button>
            <a href="{{ route('logout') }}" class="btn-action-save" style="background-color: #dc3545; border-color: #dc3545; text-decoration: none; padding: 10px 24px;">Đăng xuất</a>
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
@endsection