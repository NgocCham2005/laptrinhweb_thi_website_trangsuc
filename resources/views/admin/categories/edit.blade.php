@extends('layouts.admin')

@section('title', 'Sửa danh mục')

@section('page-title')
Quản lý danh mục sản phẩm
@endsection

@section('content')
    <div class="page-header">
        <h3>Sửa danh mục sản phẩm</h3>
    </div>
    <div class="form-grid">
    <form action="{{ route('admin.updateCategory', $category->MaDanhMuc) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <x-input type="text" name="ma_danhmuc" label="Mã danh mục" value="{{ $category->MaDanhMuc }}" disabled />
        <x-input type="text" name="ten_danhmuc" label="Tên danh mục" value="{{ $category->TenDanhMuc }}" />
        <x-input type="select" name="trang_thai" label="Trạng thái">
            <option value="1" {{ $category->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $category->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
        </x-input>
        
<div class="image-upload-grid" id="uploadCategoryGrid" style="margin-bottom: 25px;">
            <div class="upload-box-item" id="box-cat-1">
                
                <input type="file" name="hinh_anh_danhmuc" id="file-cat-1" accept="image/*" style="display: none;">
                
                <label for="file-cat-1" class="upload-box-placeholder" id="placeholder-cat-1" style="{{ $category->HinhAnh ? 'display: none;' : '' }}">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tải lên ảnh danh mục</span>
                </label>
                
                <div class="preview-zone" id="preview-cat-1" style="{{ $category->HinhAnh ? 'display: block;' : 'display: none;' }}">
                    @if($category->HinhAnh)
                        <div class="preview-item-box">
                            <img src="{{ asset('images/categories/' . $category->HinhAnh) }}" alt="Preview">
                            <span class="img-badge">Ảnh Hiện Tại</span>
                            <button type="button" class="btn-delete-img" id="btn-delete-cat">×</button>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>

        <div class="form-actions">
            <x-button variant="primary" type="submit">Cập nhật</x-button>
            <a href="{{ route('admin.categories') }}" style="text-decoration: none;">
                <x-button variant="outline-navy">
                    Quay lại
                </x-button>
            </a>
        </div>
    </form>
</div>
<script src="{{ asset('js/category-upload.js') }}"></script>
@endsection