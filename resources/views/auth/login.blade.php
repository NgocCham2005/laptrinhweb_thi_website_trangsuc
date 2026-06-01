@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://apj.vn/wp-content/uploads/2024/09/MTDB0513-bo-vang-1.jpg');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng nhập</h2>
            <p class="auth-custom-subtitle">Chào mừng quay trở lại website trang sức</p>

            {{-- ĐÃ BỔ SUNG: HỨNG THÔNG BÁO THÀNH CÔNG TỪ TRANG ĐĂNG KÝ ĐÁ SANG --}}
            @if(session('success'))
                <div class="auth-alert auth-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ĐÃ BỔ SUNG: HỨNG LỖI ĐĂNG NHẬP THẤT BẠI (SAI TK/MK, KHÓA TK) TỪ CONTROLLER --}}
            @if(session('error'))
                <div class="auth-alert auth-alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                {{-- TÀI KHOẢN --}}
                <div class="auth-group">
                    <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                    <input
                        type="text"
                        name="TenDangNhap"
                        class="auth-input"
                        placeholder="Nhập tên đăng nhập"
                        value="{{ old('TenDangNhap') }}"
                        required
                    >
                </div>

                {{-- MẬT KHẨU --}}
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

                {{-- NÚT ĐĂNG NHẬP RỘNG BẰNG FORM --}}
                <button type="submit" class="auth-btn-block">
                    Đăng nhập
                </button>
                
                {{-- LINK QUÊN MẬT KHẨU (Nằm dưới nút và lệch hẳn về góc BÊN PHẢI) --}}
                <div class="auth-forgot-right">
                    <a href="/forgot-password" class="auth-gold-link">Quên mật khẩu?</a>
                </div>
                
                {{-- CHUYỂN SANG ĐĂNG KÝ (Nằm dưới cùng và CĂN CHÍNH GIỮA) --}}
                <div class="auth-custom-footer">
                    <span>Chưa có tài khoản? </span>
                    <a href="/register" class="auth-gold-link">Đăng ký ngay</a>
                </div>
                {{-- NÚT QUAY LẠI TRANG CHỦ --}}
<div class="auth-custom-footer" style="margin-top: 12px;">
    <a href="/" class="auth-gold-link">
        <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Quay lại trang chủ
    </a>
</div>
            </form>
        </div>

    </div>
</div>

@endsection