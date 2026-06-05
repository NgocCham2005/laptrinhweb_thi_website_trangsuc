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
        <form action="{{ route('admin.updateBanner', $banner->MaBanner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input type="text" name="ma_banner" label="Mã banner" value="{{ $banner->MaBanner }}" disabled />
                <x-input type="text" name="ten_banner" label="Tên banner" value="{{ $banner->TenBanner }}" />
                <div class="image-upload-grid" id="uploadBanner" style="margin-bottom: 25px;">
                    <div class="upload-box-item" id="box-cat-1">
                        <input type="file" name="hinh_anh" id="file-cat-1" accept="image/*" style="display: none;">
                        <label for="file-cat-1" class="upload-box-placeholder" id="placeholder-cat-1" style="{{ $banner->HinhAnh ? 'display: none;' : '' }}">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tải lên ảnh banner</span>
                        </label>
            
                        <div class="preview-zone" id="preview-cat-1" style="{{ $banner->HinhAnh ? 'display: block;' : 'display: none;' }}">
                            @if($banner->HinhAnh)
                                <div class="preview-item-box">
                                    <img src="{{ asset('images/banners/' . $banner->HinhAnh) }}" alt="Preview">
                                    <span class="img-badge">Ảnh Hiện Tại</span>
                                    <button type="button" class="btn-delete-img" id="btn-delete-cat">×</button>
                                </div>
                            @endif
                        </div>    
                    </div>
                </div>
                
                <x-input type="select" name="trang_thai" label="Trạng thái">
                    <option value="1" {{ $banner->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $banner->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
                </x-input>
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    Cập nhật
                </x-button>
                <a href="{{ route('admin.banners') }}" style="text-decoration: none;">
                    <x-button variant="outline-navy">
                        Quay lại
                    </x-button>
                </a>
            </div>
        </form>
    </div>
<script src="{{ asset('js/banner-upload.js') }}"></script>
@endsection