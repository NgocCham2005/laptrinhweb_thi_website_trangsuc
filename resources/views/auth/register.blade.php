@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://file.hstatic.net/200000355853/file/15-bo-trang-suc-cuoi-vang-trang-sang-trong-h14.png');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng ký</h2>
            <p class="auth-custom-subtitle">Tạo tài khoản để trải nghiệm mua sắm</p>

            {{-- ĐÃ SỬA: SỬ DỤNG CLASS ĐỂ HIỂN THỊ LỖI THAY VÌ INLINE-STYLE --}}
            @if ($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <ul class="auth-alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf

                <div class="auth-form-grid">
                    {{-- HÀNG 1 --}}
                    <div class="auth-group">
                        <label class="auth-label">Họ tên<span class="auth-required">*</span></label>
                        <input type="text" name="HoTen" class="auth-input" placeholder="Nhập họ tên" value="{{ old('HoTen') }}" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                        <input type="text" name="TenDangNhap" class="auth-input" placeholder="Nhập tên đăng nhập" value="{{ old('TenDangNhap') }}" required>
                    </div>

                    {{-- HÀNG 2 --}}
                    <div class="auth-group">
                        <label class="auth-label">Email<span class="auth-required">*</span></label>
                        <input type="email" name="Email" class="auth-input" placeholder="Nhập Email" value="{{ old('Email') }}" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Số điện thoại<span class="auth-required">*</span></label>
                        <input type="text" name="SoDienThoai" class="auth-input" placeholder="Nhập số điện thoại" value="{{ old('SoDienThoai') }}" required>
                    </div>

                    {{-- HÀNG 3 --}}
                    <div class="auth-group">
                        <label class="auth-label">Mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="MatKhau" class="auth-input" placeholder="Từ 6 ký tự, có chữ, số, ký tự đặc biệt" required>
                    </div>

                    <div class="auth-group">
                        <label class="auth-label">Nhập lại mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="NhapLaiMatKhau" class="auth-input" placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>

                {{-- NÚT ĐĂNG KÝ RỘNG BẰNG FORM --}}
                <button type="submit" class="auth-btn-block">
                    Đăng ký
                </button>
                
                {{-- FOOTER CHUYỂN VỀ ĐĂNG NHẬP --}}
                <div class="auth-custom-footer">
                    <span>Đã có tài khoản? </span>
                    <a href="/login" class="auth-gold-link">Đăng nhập</a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection