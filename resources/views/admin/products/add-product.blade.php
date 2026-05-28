@extends('layouts.admin')

@section('title','Thêm sản phẩm')

@section('page-title')
Quản lý sản phẩm
@endsection

@section('content')
    <div class="page-header">
        <h3>Thêm sản phẩm mới</h3>
    </div>

    <div class="form-grid">
        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input type="text" name="ma_sanpham" label="Mã sản phẩm" placeholder="Ví dụ: SP001" />
                <x-input type="text" name="ten_sanpham" label="Tên sản phẩm" placeholder="Nhập tên sản phẩm" />
                
                <x-input type="select" name="ma_danhmuc" label="Danh mục sản phẩm">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->MaDanhMuc }}">{{ $cat->TenDanhMuc }}</option>
                    @endforeach
                </x-input>

                <x-input type="number" name="gia_ban" label="Giá bán (VNĐ)" placeholder="Nhập giá bán" />
                <x-input type="text" name="chat_lieu" label="Chất liệu" placeholder="Ví dụ: Vàng 18K, Bạc Ý..." />
                
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:600; margin-bottom:5px;">Mô tả sản phẩm</label>
                    <textarea name="mo_ta" class="form-control" rows="4" style="width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:10px;" placeholder="Nhập mô tả sản phẩm..."></textarea>
                </div>

                <div class="form-group-image">
                    <label>Hình ảnh sản phẩm (Chọn tối đa 3 ảnh)</label>
                    <input type="file" name="hinh_anh[]" class="input-file-custom" multiple>
                </div>
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    <i class="fa-solid fa-floppy-disk"></i> Lưu sản phẩm
                </x-button>
                <a href="{{ route('admin.products') }}">
                    <x-button type="button">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </x-button>
                </a>
            </div>
        </form>
    </div>
@endsection