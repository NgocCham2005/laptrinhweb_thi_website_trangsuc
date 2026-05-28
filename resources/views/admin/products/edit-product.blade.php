@extends('layouts.admin')

@section('title','Sửa sản phẩm')

@section('page-title')
Quản lý sản phẩm
@endsection

@section('content')
    <div class="page-header">
        <h3>Sửa sản phẩm</h3>
    </div>

    <div class="form-grid">
        <form action="{{ route('admin.updateProduct', $product->MaSanPham) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <x-input type="text" name="ma_sanpham" label="Mã sản phẩm" value="{{ $product->MaSanPham }}" disabled />
                <x-input type="text" name="ten_sanpham" label="Tên sản phẩm" value="{{ $product->TenSanPham }}" />
                
                <x-input type="select" name="ma_danhmuc" label="Danh mục sản phẩm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->MaDanhMuc }}" {{ $product->MaDanhMuc == $cat->MaDanhMuc ? 'selected' : '' }}>
                            {{ $cat->TenDanhMuc }}
                        </option>
                    @endforeach
                </x-input>

                <x-input type="number" name="gia_ban" label="Giá bán (VNĐ)" value="{{ $product->GiaBan }}" />
                <x-input type="text" name="chat_lieu" label="Chất liệu" value="{{ $product->ChatLieu }}" />
                
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:600; margin-bottom:5px;">Mô tả sản phẩm</label>
                    <textarea name="mo_ta" class="form-control" rows="4" style="width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:10px;">{{ $product->MoTa }}</textarea>
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; font-weight:600; margin-bottom:5px;">Ảnh hiện tại:</label>
                    <img src="{{ asset('images/product/' . $product->HinhAnh) }}" width="150" style="border-radius:8px;" alt="Ảnh sản phẩm">
                </div>
                <x-input type="file" name="hinh_anh" label="Chọn ảnh mới (nếu muốn thay đổi)" />

                <x-input type="select" name="trang_thai" label="Trạng thái">
                    <option value="1" {{ $product->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $product->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
                </x-input>
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">Cập nhật sản phẩm</x-button>
                <a href="{{ route('admin.products') }}">
                    <x-button type="button">Quay lại</x-button>
                </a>
            </div>
        </form>
    </div>
@endsection