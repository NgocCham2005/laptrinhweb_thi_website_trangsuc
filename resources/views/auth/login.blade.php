@extends('layouts.auth')
@section('content')

<div class="auth-container">

    <div class="auth-box">

        <h2 class="auth-title">

            Đăng nhập

        </h2>

        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR --}}
        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <form action="/login" method="POST">

            @csrf

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

            <button
                type="submit"
                class="btn btn-primary btn-block"
            >

                Đăng nhập

            </button>
            <div class="mt-3 text-center">

    <a
        href="/forgot-password"
        class="text-decoration-none"
    >
        Quên mật khẩu?
    </a>

</div>

        </form>

    </div>

</div>

@endsection