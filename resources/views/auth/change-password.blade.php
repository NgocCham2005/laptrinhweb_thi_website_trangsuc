@extends('layouts.auth')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h3>Đổi mật khẩu</h3>
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

                    <form method="POST" action="/change-password">

                        @csrf

                        <div class="mb-3">

                            <label>
                                Mật khẩu cũ
                            </label>

                            <input
                                type="password"
                                name="MatKhauCu"
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
                                Nhập lại mật khẩu mới
                            </label>

                            <input
                                type="password"
                                name="NhapLaiMatKhauMoi"
                                class="form-control"
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-dark"
                        >
                            Đổi mật khẩu
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection