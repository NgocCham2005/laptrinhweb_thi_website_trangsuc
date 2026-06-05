@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    {{-- Sử dụng class auth-card-single để hộp chứa thu nhỏ gọn gàng --}}
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">

            <h2 class="auth-custom-title">Đổi mật khẩu</h2>
            <p class="auth-custom-subtitle">Vui lòng nhập mật khẩu cũ và mật khẩu mới</p>

            @if(session('success'))
                <div class="alert alert-success" style="text-align: center; justify-content: center; display: flex;">
                    {{ session('success') }}
                </div>
            @endif



        
            {{-- Có thuộc tính novalidate để chặn đứng bong bóng mặc định của trình duyệt --}}
            <form action="/change-password" method="POST" novalidate style="width: 100%;">
                @csrf

                {{-- MẬT KHẨU CŨ --}}
                <div class="form-group">
                    <label class="form-label">Mật khẩu cũ<span class="required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauCu" 
                        class="form-control @error('MatKhauCu') is-invalid @enderror @error('matkhaucu') is-invalid @enderror" 
                        placeholder="Nhập mật khẩu hiện tại" 
                        required
                    >
                    @error('MatKhauCu') <div class="form-error">{{ $message }}</div> @enderror
                    @error('matkhaucu') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- MẬT KHẨU MỚI --}}
                <div class="form-group">
                    <label class="form-label">Mật khẩu mới<span class="required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauMoi" 
                        class="form-control @error('MatKhauMoi') is-invalid @enderror @error('matkhaumoi') is-invalid @enderror @error('password') is-invalid @enderror" 
                        placeholder="Nhập mật khẩu mới" 
                        required
                    >
                    @error('MatKhauMoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('matkhaumoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- NHẬP LẠI MẬT KHẨU MỚI --}}
                <div class="form-group">
                    <label class="form-label">Nhập lại mật khẩu mới<span class="required">*</span></label>
                    <input 
                        type="password" 
                        name="NhapLaiMatKhauMoi" 
                        class="form-control @error('NhapLaiMatKhauMoi') is-invalid @enderror @error('nhaplaimatkhaumoi') is-invalid @enderror @error('password_confirmation') is-invalid @enderror" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                    @error('NhapLaiMatKhauMoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('nhaplaimatkhaumoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- NÚT BẤM ĐỔI MẬT KHẨU --}}
                <button type="submit" class="btn btn-secondary btn-block" style="height: 48px; border-radius: 14px;">
                    Đổi mật khẩu
                </button>
                
                {{-- NÚT QUAY LẠI TRANG CHỦ --}}
                <div style="text-align: left; margin-top: 16px;">
                    <a href="/" class="btn btn-outline-navy btn-sm" style="text-decoration: none;">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- Tự động redirect về trang chủ hoặc trang cá nhân sau 3s nếu đổi thành công --}}
@if(session('success'))
<script>
    setTimeout(function() {
        window.location.href = '/';
    }, 3000);
</script>
@endif

@endsection
