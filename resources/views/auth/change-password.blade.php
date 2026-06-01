@extends('layouts.auth')
@section('content')

<div class="auth-page-wrapper">
    {{-- Đồng bộ class auth-card-single để hộp chứa thu nhỏ gọn gàng, không bị lệch giao diện --}}
    <div class="auth-split-card auth-card-single">
        
        <div class="auth-side-form">
            <h2 class="auth-custom-title">Đổi mật khẩu</h2>
            <p class="auth-custom-subtitle">Vui lòng nhập mật khẩu cũ và mật khẩu mới</p>

            {{-- HỨNG THÔNG BÁO THÀNH CÔNG (Hiện chữ màu xanh lá cây, không có ô khung nền) --}}
            @if(session('success'))
                <div style="color: #28a745 !important; font-weight: bold; text-align: center; margin-bottom: 20px; font-size: 16px;">
                    <i class="fas fa-check-circle" style="color: #28a745 !important; margin-right: 5px;"></i> {{ session('success') }}
                </div>
            @endif

            {{-- HỨNG THÔNG BÁO LỖI SAI MẬT KHẨU CŨ --}}
            @if(session('error'))
                <div class="auth-alert auth-alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- HỨNG LỖI VALIDATION (Nếu mật khẩu mới không đủ 6 ký tự hoặc không khớp) --}}
            @if ($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <ul class="auth-alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/change-password">
                @csrf

                {{-- MẬT KHẨU CŨ --}}
                <div class="auth-group">
                    <label class="auth-label">Mật khẩu cũ<span class="auth-required">*</span></label>
                    <input 
                        type="password" 
                        name="MatKhauCu" 
                        class="auth-input" 
                        placeholder="Nhập mật khẩu hiện tại" 
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
                        name="NhapLaiMatKhauMoi" 
                        class="auth-input" 
                        placeholder="Nhập lại mật khẩu mới" 
                        required
                    >
                </div>

                {{-- NÚT BẤM THỰC HIỆN --}}
                <button type="submit" class="auth-btn-block">
                    Đổi mật khẩu
                </button>
                
                {{-- FOOTER QUAY LẠI TRANG CHỦ HOẶC PROFILE --}}
                <div class="auth-custom-footer" style="margin-top: 25px;">
                    <a href="/profile" class="auth-gold-link">
                        <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
