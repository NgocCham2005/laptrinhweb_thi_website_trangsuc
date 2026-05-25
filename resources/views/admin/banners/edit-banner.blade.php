@extends('layouts.admin')

@section('title','Sửa banner')

@section('page-title')

Quản lý banner

@endsection

@section('content')

    <div class="page-header">
        <h3>Sửa banner</h3>
    </div>

    <div class="form-grid">

        <form action="{{ route('admin.updateBanner', $banner->MaBanner) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <x-input type="text" name="ma_banner" label="Mã banner" value="{{ $banner->MaBanner }}" disabled />
                <x-input type="text" name="ten_banner" label="Tên banner" value="{{ $banner->TenBanner }}" />
                <img src="{{ asset('images/banner/' . $banner->HinhAnh) }}" label="Ảnh hiện tại" width="250" alt="Ảnh hiện tại">
                <br><br>
                <x-input type="file" name="hinh_anh" label="Chọn ảnh mới" />
                <x-input type="select" name="trang_thai" label="Trạng thái">
                    <option value="1" {{ $banner->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $banner->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
                </x-input>
            </div>

            <div class="action-buttons">
                <x-button type="submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Cập nhật
                </x-button>
                <a href="{{ route('admin.banners') }}">
                    <x-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </x-button>
                </a>
            </div>
        </form>
    </div>

@endsection