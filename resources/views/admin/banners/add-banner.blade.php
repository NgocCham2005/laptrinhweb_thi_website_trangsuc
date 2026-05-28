@extends('layouts.admin')

@section('title','Thêm banner')

@section('page-title')

Quản lý banner

@endsection

@section('content')

    <div class="page-header">
        <h3>Thêm banner</h3>
    </div>

    <div class="form-grid">
        <form action="{{ route('admin.storeBanner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input type="text" name="ma_banner" label="Mã banner" placeholder="Nhập mã banner" />
                <x-input type="text" name="ten_banner" label="Tên banner" placeholder="Nhập tên banner" />
                <x-input type="file" name="hinh_anh" label="Hình ảnh banner" />
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    Lưu banner
                </x-button>
                <a href="{{ route('admin.banners') }}" style="text-decoration: none;">
                    <x-button variant="outline-navy">
                        Quay lại
                    </x-button>
                </a>
            </div>
        </form>
    </div>

@endsection