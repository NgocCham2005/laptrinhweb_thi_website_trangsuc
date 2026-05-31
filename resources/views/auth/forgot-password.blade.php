@extends('layouts.auth')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h3>Quên mật khẩu</h3>
                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif

                    @if(session('error'))

                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                    @endif

                    <form method="POST" action="/forgot-password">

                        @csrf

                        <div class="mb-3">

                            <label>
                                Email
                            </label>

                            <input
                                type="email"
                                name="Email"
                                class="form-control"
                            >

                        </div>

                        <div class="mb-3">

                            <label>
                                Mật khẩu mới
                            </label>

                            <input
                                type="password"
                                name="MatKhauMoi"
                                class="form-control"
                            >

                        </div>

                        <div class="mb-3">

                            <label>
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
                            class="btn btn-dark"
                        >
                            Đặt lại mật khẩu
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection