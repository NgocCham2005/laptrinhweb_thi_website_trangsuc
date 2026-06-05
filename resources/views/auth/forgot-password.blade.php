@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    {{-- Sử dụng class auth-card-single để hộp chứa thu nhỏ gọn gàng --}}
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Quên mật khẩu</h2>
            <p class="auth-custom-subtitle">Nhập email và mật khẩu mới để khôi phục</p>





            @if(session('success'))
                <div class="alert alert-success" style="text-align: center; justify-content: center; display: flex;">
                    {{ session('success') }}
                </div>
            @endif

            
            
            @if(session('error'))
                <div class="alert alert-danger" style="text-align: center; justify-content: center; display: flex;">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Có thuộc tính novalidate để chặn đứng bong bóng mặc định của trình duyệt --}}
            <form action="/forgot-password" method="POST" novalidate>
                @csrf

                {{-- EMAIL --}}
                <div class="auth-group">
                    <label class="auth-label">Email<span class="auth-required">*</span></label>
                    <input 
                        type="email" 
                        name="Email" 
                        class="auth-input @error('Email') is-invalid @enderror @error('email') is-invalid @enderror @if(session('error')) is-invalid @endif" 
                        placeholder="Nhập Email" 
                        value="{{ old('Email') }}" 
                        required
                    >
                    @error('Email') <div class="form-error">{{ $message }}</div> @enderror
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- MẬT KHẨU MỚI --}}
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu mới<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauMoi" 
                        class="auth-input @error('MatKhauMoi') is-invalid @enderror @error('matkhaumoi') is-invalid @enderror @error('password') is-invalid @enderror" 
                        placeholder="Nhập mật khẩu mới" 
                        required
                    >
                    @error('MatKhauMoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('matkhaumoi') <div class="form-error">{{ $message }}</div> @enderror
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- NHẬP LẠI MẬT KHẨU MỚI --}}
                <div class="auth-group">
                    <label class="auth-label">Nhập lại mật khẩu mới<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="NhapLaiMatKhau" 
                        class="auth-input @error('NhapLaiMatKhau') is-invalid @enderror @error('nhaplaimatkhau') is-invalid @enderror @error('password_confirmation') is-invalid @enderror" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                    @error('NhapLaiMatKhau') <div class="form-error">{{ $message }}</div> @enderror
                    @error('nhaplaimatkhau') <div class="form-error">{{ $message }}</div> @enderror
                    @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- NÚT BẤM ĐẶT LẠI MẬT KHẨU --}}
                <button type="submit" class="auth-btn-block">
                    Đặt lại mật khẩu
                </button>
           
                
            </form>
        </div>

    </div>
</div>

{{-- Tự động redirect về login sau 3s nếu đổi thành công --}}
@if(session('success'))
<script>
    setTimeout(function() {
        window.location.href = '/login';
    }, 3000);
</script>
@endif

@endsection