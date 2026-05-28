@extends('layouts.admin')

@section('title', 'Sửa danh mục')

@section('content')
<div class="form-container">
    <h3>Cập nhật danh mục sản phẩm</h3>
    <form action="{{ route('admin.updateCategory', $category->MaDanhMuc) }}" method="POST">
        @csrf
        @method('PUT')
        
        <x-input type="text" name="ma_danhmuc" label="Mã danh mục" value="{{ $category->MaDanhMuc }}" disabled />
        <x-input type="text" name="ten_danhmuc" label="Tên danh mục" value="{{ $category->TenDanhMuc }}" />
        <x-input type="select" name="trang_thai" label="Trạng thái">
            <option value="1" {{ $category->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $category->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
        </x-input>
        
        <div class="form-actions">
            <x-button variant="primary" type="submit">Cập nhật</x-button>
            <a href="{{ route('admin.categories') }}"
                <x-button type="button">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </x-button>
            </a>
        </div>
    </form>
</div>
@endsection