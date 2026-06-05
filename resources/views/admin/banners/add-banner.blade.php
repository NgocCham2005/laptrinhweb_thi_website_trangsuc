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
                <x-input label="Mã banner" name="ma_banner" :value="$maBanner" readonly />
                <x-input type="text" name="ten_banner" label="Tên banner" placeholder="Nhập tên banner" />
                
                <div class="image-upload-grid" id="uploadBanner" style="margin-bottom: 5px;">
                    <div class="upload-box-item" id="box-cat-1">
                    <input type="file" name="hinh_anh" id="file-cat-1" accept="image/*" style="display: none;">
                        @if(session('temp_image'))
                        <input type="hidden" name="temp_hinh_anh" id="temp_hinh_anh" value="{{ session('temp_image') }}">
                        @endif
        
                    <label for="file-cat-1" class="upload-box-placeholder" id="placeholder-cat-1" @if(session('temp_image')) style="display: none;" @endif>
                        <i class="fa-solid fa-plus"></i>
                        <span>Tải lên ảnh banner</span>
                    </label>
        
                    <div class="preview-zone" id="preview-cat-1" @if(session('temp_image')) style="display: block;" @else style="display: none;" @endif>
                        @if(session('temp_image'))
                            <div class="preview-item-box">
                                <img src="{{ asset('images/banners/' . session('temp_image')) }}" alt="Preview">
                                <span class="img-badge">Ảnh đã tải lên</span>
                                <button type="button" class="btn-delete-img" id="btn-delete-cat">×</button>
                            </div>
                        @endif
                    </div>
                    </div>
                </div>
                @error('hinh_anh')
                    <div class="form-error" style="margin-top: 0; margin-bottom: 20px;">{{ $message }}</div>
                @enderror
            </div>
            <br>
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
<script src="{{ asset('js/banner-upload.js') }}"></script>
@endsection