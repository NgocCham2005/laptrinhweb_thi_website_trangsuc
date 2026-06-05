@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    {{-- Thêm class auth-card-single để ép hộp chứa thu nhỏ gọn gàng, không bị lệch --}}
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Quên mật khẩu</h2>
            <p class="auth-custom-subtitle">Nhập email và mật khẩu mới</p>

            {{-- HỨNG THÔNG BÁO THÀNH CÔNG (Ép màu xanh lá cây trực tiếp bằng thuộc tính style) --}}
            @if(session('success'))
                <div style="color: #28a745 !important; font-weight: bold; text-align: center; margin-bottom: 20px; font-size: 16px;">
                    <i class="fas fa-check-circle" style="color: #28a745 !important; margin-right: 5px;"></i> {{ session('success') }}
                </div>
            @endif

            {{-- HỨNG LỖI VALIDATION --}}
            @if ($errors->any())
                <div class="margin-bottom: 16px;">

                    @foreach ($errors->all() as $error)
                    <p style="color: #ef4444; font-size: 15px; font-weight: 600; margin: 0 0 8px 0;text-align: center;">
            <i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                    @endforeach


                </div>
            @endif

            <form action="/forgot-password" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="auth-group">
                    <label class="auth-label">Email<span class="auth-required">*</span></label>
                    <input 
                        type="email" 
                        name="Email" 
                        class="auth-input" 
                        placeholder="Nhập Email" 
                        value="{{ old('Email') }}" 
                        required
                    >
                </div>

                {{-- MẬT KHẨU MỚI --}}
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

                {{-- NHẬP LẠI MẬT KHẨU MỚI --}}
                <div class="auth-group">
                    <label class="auth-label">Nhập lại mật khẩu mới<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="NhapLaiMatKhau" 
                        class="auth-input" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                </div>

                {{-- NÚT BẤM ĐẶT LẠI MẬT KHẨU --}}
                <button type="submit" class="auth-btn-block">
                    Đặt lại mật khẩu
                </button>
                
                
            </form>
        </div>

    </div>
</div>
{{-- Tự redirect về login sau 3s nếu có thông báo thành công --}}
@if(session('success'))
<script>
    setTimeout(function() {
        window.location.href = '/login';
    }, 3000);
</script>
@endif

@endsection