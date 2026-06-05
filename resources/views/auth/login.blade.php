@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-side-image" style="background-image: url('https://file.hstatic.net/200000355853/file/15-bo-trang-suc-cuoi-vang-trang-sang-trong-h14.png');">
        </div>

        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đăng nhập</h2>
            <p class="auth-custom-subtitle">Chào mừng quay trở lại website trang sức</p>

            {{-- CHỈ HIỆN ALERT XANH KHI ĐĂNG KÝ THÀNH CÔNG TỪ TRANG KHÁC ĐÁ SANG --}}
            @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

            <form action="/login" method="POST" novalidate>
                @csrf

                {{-- TÊN ĐĂNG NHẬP --}}
                <div class="auth-group">

                    <label class="auth-label">Tên đăng nhập<span class="auth-required">*</span></label>
                    {{-- Nếu dính session('error') thì lập tức ép class is-invalid để lên viền đỏ --}}
                    <input
                        type="text"
                        name="TenDangNhap"
                        class="auth-input @if(session('error')) is-invalid @endif"
                        placeholder="Nhập tên đăng nhập"
                        value="{{ old('TenDangNhap') }}"
                        required
                    >
                    @if(session('error'))
                        <div class="form-error">Tên đăng nhập không chính xác</div>
                    @endif
                </div>

                {{-- MẬT KHẨU --}}
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu<span class="auth-required">*</span></label>
                    {{-- Nếu dính session('error') thì lập tức ép class is-invalid để lên viền đỏ --}}
                    <input
                        type="password"
                        name="MatKhau"
                        class="auth-input @if(session('error')) is-invalid @endif"
                        placeholder="Nhập mật khẩu"
                        required
                    >
                    @if(session('error'))
                        <div class="form-error">Mật khẩu không đúng, vui lòng kiểm tra lại</div>
                    @endif
                </div>

                {{-- NÚT ĐĂNG NHẬP --}}
                <button type="submit" class="auth-btn-block">
                    Đăng nhập
                </button>
                
                {{-- LINK QUÊN MẬT KHẨU --}}
                <div class="auth-forgot-right">
                    <a href="/forgot-password" class="auth-gold-link">Quên mật khẩu?</a>
                </div>
                
                {{-- LINK SANG ĐĂNG KÝ --}}
                <div class="auth-custom-footer">
                    <span>Chưa có tài khoản? </span>
                    <a href="/register" class="auth-gold-link">Đăng ký ngay</a>
                </div>


            </form>
        </div>

    </div>
</div>

@endsection