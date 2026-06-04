@extends('layouts.admin')

@section('title', 'Thêm danh mục mới')

@section('page-title')
Quản lý danh mục sản phẩm
@endsection

@section('content')
<div class="form-grid">
    <div class="page-header">
        <h3>Thêm danh mục sản phẩm mới</h3>
    </div>
    <form action="{{ route('admin.storeCategory') }}" method="POST">
        @csrf
        <x-input type="text" name="ma_danhmuc" label="Mã danh mục" placeholder="Ví dụ: DM01" />
        <x-input type="text" name="ten_danhmuc" label="Tên danh mục" placeholder="Nhập tên danh mục..." />
        <div class="form-group" style="margin-top: 15px;">
    <label>Ảnh đại diện danh mục</label>
    
<div class="image-upload-grid" id="uploadCategoryGrid" style="margin-bottom: 25px;">
    <div class="upload-box-item" id="box-cat-1">
        
        <input type="file" name="hinh_anh_danhmuc" id="file-cat-1" accept="image/*" style="display: none;">
        
        <label for="file-cat-1" class="upload-box-placeholder" id="placeholder-cat-1">
            <i class="fa-solid fa-plus"></i>
            <span>Tải lên ảnh danh mục</span>
        </label>
        
        <div class="preview-zone" id="preview-cat-1" style="display: none;"></div>
        
    </div>
</div>
        <div class="form-actions">
            <x-button variant="primary" type="submit">Lưu danh mục</x-button>
            <a href="{{ route('admin.categories') }}"
                <x-button type="button">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </x-button>
            </a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/category-upload.js') }}"></script>
@endsection