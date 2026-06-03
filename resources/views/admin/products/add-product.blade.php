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
                        <option value="{{ $cat->MaDanhMuc }}" {{ old('ma_danhmuc') == $cat->MaDanhMuc ? 'selected' : '' }}>
                            {{ $cat->TenDanhMuc }}
                        </option>
                    @endforeach
                </x-input>

                <x-input type="number" name="gia_ban" label="Giá bán (VNĐ)" placeholder="Nhập giá bán" min="0"/>
                <x-input type="number" name="so_luong_ton" label="Số lượng tồn kho" placeholder="Nhập số lượng sản phẩm trong kho" min="0" />
                <x-input type="text" name="chat_lieu" label="Chất liệu" placeholder="Ví dụ: Vàng 18K, Bạc Ý..." />
<<<<<<< Updated upstream
                <label style="cursor: pointer;">
                <input type="checkbox" name="noi_bat" value="1" class="form-check-input me-2" 
       {{ isset($product) && $product->NoiBat == 1 ? 'checked' : '' }}>
                Sản phẩm nổi bật</label>
       <x-input type="textarea" name="mo_ta" label="Mô tả sản phẩm"  placeholder="Nhập mô tả sản phẩm..."  rows="4"/>            <div class="form-group-image">
=======
                
                <x-input type="textarea" name="mo_ta" label="Mô tả sản phẩm"  placeholder="Nhập mô tả sản phẩm..."  rows="4"/>            <div class="form-group-image">
>>>>>>> Stashed changes
                <label>Hình ảnh sản phẩm (Chọn từ 1 đến 3 ảnh) <span style="color: red;">*</span></label>
                
                <div class="image-upload-grid" id="uploadGrid">
                    <div class="upload-box-item" id="box-1">
                        <input type="file" name="hinh_anh_chinh" id="file-1" accept="image/*" style="display: none;">
                        <label for="file-1" class="upload-box-placeholder">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tải lên ảnh 1</span>
                        </label>
                        <div class="preview-zone" style="display: none;"></div>
                    </div>

                    <div class="upload-box-item" id="box-2" style="display: none;">
                        <input type="file" name="hinh_anh_phu[]" id="file-2" accept="image/*" style="display: none;">
                        <label for="file-2" class="upload-box-placeholder">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tải lên ảnh 2</span>
                        </label>
                        <div class="preview-zone" style="display: none;"></div>
                    </div>

                    <div class="upload-box-item" id="box-3" style="display: none;">
                        <input type="file" name="hinh_anh_phu[]" id="file-3" accept="image/*" style="display: none;">
                        <label for="file-3" class="upload-box-placeholder">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tải lên ảnh 3</span>
                        </label>
                        <div class="preview-zone" style="display: none;"></div>
                    </div>
                </div>
            </div>
    </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    Lưu sản phẩm
                </x-button>
                <a href="{{ route('admin.products') }}">
                    <x-button type="button">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </x-button>
                </a>
            </div>
        </form>
    </div>
@if ($errors->any())
    <div id="laravel-errors-data" data-errors="{{ json_encode($errors->all()) }}" style="display: none;"></div>
@endif

@if (session('success'))
    <div id="laravel-success-data" data-message="{{ session('success') }}" style="display: none;"></div>
@endif

{{-- Nhúng thư viện lõi SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<<<<<<< Updated upstream
=======

{{-- Nhúng 1 file duy nhất chứa toàn bộ tinh hoa upload và kiểm tra lỗi --}}
>>>>>>> Stashed changes
<script src="{{ asset('js/product-upload.js') }}"></script>
@endsection