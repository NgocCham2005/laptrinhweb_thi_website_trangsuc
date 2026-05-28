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
        
        <div class="form-actions">
            <x-button variant="primary" type="submit">Lưu lại</x-button>
            <a href="{{ route('admin.categories') }}"
                <x-button type="button">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </x-button>
            </a>
        </div>
    </form>
</div>
@endsection