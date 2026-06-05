@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    <div class="auth-split-card auth-card-single">        
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng ký</h2>
            <p class="auth-custom-subtitle">Tạo tài khoản để trải nghiệm mua sắm</p>

            {{-- ALERT CHUNG THEO FORM.CSS (CHỈ HIỆN KHI CÓ THÔNG BÁO THÀNH CÔNG/THẤT BẠI CHUNG) --}}
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 16px;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom: 16px;">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf

                <div class="auth-form-grid">
                    {{-- HÀNG 1: HỌ TÊN --}}
                    <div class="auth-group">
                        <label class="auth-label">Họ tên<span class="auth-required">*</span></label>
                        <input type="text" name="HoTen" class="auth-input @error('HoTen') is-invalid @enderror" placeholder="Nhập họ tên" value="{{ old('HoTen') }}" required>
                        @error('HoTen')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HÀNG 1: TÊN ĐĂNG NHẬP --}}
                    <div class="auth-group">
                        <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                        <input type="text" name="TenDangNhap" class="auth-input @error('TenDangNhap') is-invalid @enderror" placeholder="Nhập tên đăng nhập" value="{{ old('TenDangNhap') }}" required>
                        @error('TenDangNhap')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HÀNG 2: EMAIL --}}
                    <div class="auth-group">
                        <label class="auth-label">Email<span class="auth-required">*</span></label>
                        <input type="email" name="Email" class="auth-input @error('Email') is-invalid @enderror" placeholder="Nhập Email" value="{{ old('Email') }}" required>
                        @error('Email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HÀNG 2: SỐ ĐIỆN THOẠI --}}
                    <div class="auth-group">
                        <label class="auth-label">Số điện thoại<span class="auth-required">*</span></label>
                        <input type="text" name="SoDienThoai" class="auth-input @error('SoDienThoai') is-invalid @enderror" placeholder="Nhập số điện thoại" value="{{ old('SoDienThoai') }}" required>
                        @error('SoDienThoai')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HÀNG 3: MẬT KHẨU --}}
                    <div class="auth-group">
                        <label class="auth-label">Mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="MatKhau" class="auth-input @error('MatKhau') is-invalid @enderror" placeholder="Từ 6 ký tự, có chữ, số, ký tự đặc biệt" required>
                        @error('MatKhau')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HÀNG 3: NHẬP LẠI MẬT KHẨU --}}
                    <div class="auth-group">
                        <label class="auth-label">Nhập lại mật khẩu<span class="auth-required">*</span></label>
                        <input type="password" name="NhapLaiMatKhau" class="auth-input @error('NhapLaiMatKhau') is-invalid @enderror" placeholder="Nhập lại mật khẩu" required>
                        @error('NhapLaiMatKhau')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- NÚT ĐĂNG KÝ --}}
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