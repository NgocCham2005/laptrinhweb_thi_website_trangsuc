@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://file.hstatic.net/200000355853/file/15-bo-trang-suc-cuoi-vang-trang-sang-trong-h14.png');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng nhập</h2>
            <p class="auth-custom-subtitle">Chào mừng quay trở lại website trang sức</p>

            {{-- ĐÃ BỔ SUNG: HỨNG THÔNG BÁO THÀNH CÔNG TỪ TRANG ĐĂNG KÝ ĐÁ SANG --}}
            @if(session('success'))
                <p style="color: #28a745; font-size: 15px; font-weight: 600; margin: 0 0 16px 0; text-align: center;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </p>
            @endif

            {{-- ĐÃ BỔ SUNG: HỨNG LỖI ĐĂNG NHẬP THẤT BẠI (SAI TK/MK, KHÓA TK) TỪ CONTROLLER --}}
            @if(session('error'))
                <p style="color: #ef4444; font-size: 15px; font-weight: 600; margin: 0 0 16px 0; text-align: center;">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </p>
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

                

            </form>
        </div>

    </div>
</div>

@endsection