@extends('layouts.auth')

@section('content')

<div class="auth-container">

    <div class="auth-box">

        <h2 class="auth-title">

            Đăng ký

        </h2>

        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="/register" method="POST">

            @csrf

            {{-- HỌ TÊN --}}
            <div class="form-group">

                <label class="form-label">

                    Họ tên

                </label>

                <input
                    type="text"
                    name="HoTen"
                    class="form-control"
                    value="{{ old('HoTen') }}"
                >

            </div>

            {{-- USERNAME --}}
            <div class="form-group">

                <label class="form-label">

                    Tên đăng nhập

                </label>

                <input
                    type="text"
                    name="TenDangNhap"
                    class="form-control"
                    value="{{ old('TenDangNhap') }}"
                >

            </div>

            {{-- EMAIL --}}
            <div class="form-group">

                <label class="form-label">

                    Email

                </label>

                <input
                    type="email"
                    name="Email"
                    class="form-control"
                    value="{{ old('Email') }}"
                >

            </div>

            {{-- PHONE --}}
            <div class="form-group">

                <label class="form-label">

                    Số điện thoại

                </label>

                <input
                    type="text"
                    name="SoDienThoai"
                    class="form-control"
                    value="{{ old('SoDienThoai') }}"
                >

            </div>

            {{-- PASSWORD --}}
            <div class="form-group">

                <label class="form-label">

                    Mật khẩu

                </label>

                <input
                    type="password"
                    name="MatKhau"
                    class="form-control"
                >

            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="form-group">

                <label class="form-label">

                    Nhập lại mật khẩu

                </label>

                <input
                    type="password"
                    name="NhapLaiMatKhau"
                    class="form-control"
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary btn-block"
            >

                Đăng ký

            </button>

        </form>

    </div>

</div>

@endsection