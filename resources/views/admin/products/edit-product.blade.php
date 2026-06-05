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
                <x-input type="number" name="so_luong_ton" label="Số lượng tồn kho" value="{{ $product->SoLuongTon ?? 0 }}" min="0" />

                <x-input type="text" name="chat_lieu" label="Chất liệu" value="{{ $product->ChatLieu }}" />
                <x-input type="textarea" name="mo_ta" label="Mô tả sản phẩm" placeholder="Nhập mô tả sản phẩm..." rows="4" value="{{ $product->MoTa }}" />
                <x-input type="textarea" name="mota_chitiet" label="Mô tả chi tiết sản phẩm" rows="6">
                    {{ old('mota_chitiet', $product->MoTaChiTiet) }}
                </x-input>
                   <label style="cursor: pointer;">
                <input type="checkbox" name="noi_bat" value="1" class="form-check-input me-2" 
                    {{ isset($product) && $product->NoiBat == 1 ? 'checked' : '' }}>
                Sản phẩm nổi bật</label>
                <br>
                <div class="form-group-image">
                <label>Hình ảnh sản phẩm</label>
    
        <div class="image-upload-grid" id="uploadGrid">
        
        @php $img1 = isset($images) ? $images->get(0) : null; @endphp
        <div class="upload-box-item upload-box-item-edit" id="box-1">
            <input type="file" name="hinh_anh_chinh" id="file-1" accept="image/*" style="display: none;">
            @if($img1 && $img1->DuongDan)
                <div class="preview-zone" style="display: block;">
                    <div class="preview-item-box">
                        <img src="{{ asset('images/products/' . $img1->DuongDan) }}" alt="Ảnh đại diện">
                        <span class="img-badge" style="background: #ff5722;">Ảnh Đại Diện</span>
                        <button type="button" class="btn-delete-img" onclick="clearSingleImage(1, '{{ $img1->MaHinhAnh }}')">×</button>
                    </div>
                </div>
                <label for="file-1" class="upload-box-placeholder" style="display: none;">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 1</span>
                </label>
            @else
                <div class="preview-zone" style="display: none;"></div>
                <label for="file-1" class="upload-box-placeholder">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 1</span>
                </label>
            @endif
        </div>

        @php $img2 = isset($images) ? $images->get(1) : null; @endphp
        <div class="upload-box-item upload-box-item-edit" id="box-2">
            <input type="file" name="hinh_anh_phu[]" id="file-2" accept="image/*" style="display: none;">
            @if($img2 && $img2->DuongDan)
                <div class="preview-zone" style="display: block;">
                    <div class="preview-item-box">
                        <img src="{{ asset('images/products/' . $img2->DuongDan) }}" alt="Ảnh chi tiết 1">
                        <span class="img-badge">Ảnh Chi Tiết 1</span>
                        <button type="button" class="btn-delete-img" onclick="clearSingleImage(2, '{{ $img2->MaHinhAnh }}')">×</button>
                    </div>
                </div>
                <label for="file-2" class="upload-box-placeholder" style="display: none;">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 2</span>
                </label>
            @else
                <div class="preview-zone" style="display: none;"></div>
                <label for="file-2" class="upload-box-placeholder">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 2</span>
                </label>
            @endif
        </div>

        @php $img3 = isset($images) ? $images->get(2) : null; @endphp
        <div class="upload-box-item upload-box-item-edit" id="box-3">
            <input type="file" name="hinh_anh_phu[]" id="file-3" accept="image/*" style="display: none;">
            @if($img3 && $img3->DuongDan)
                <div class="preview-zone" style="display: block;">
                    <div class="preview-item-box">
                        <img src="{{ asset('images/products/' . $img3->DuongDan) }}" alt="Ảnh chi tiết 2">
                        <span class="img-badge">Ảnh Chi Tiết 2</span>
                        <button type="button" class="btn-delete-img" onclick="clearSingleImage(3, '{{ $img3->MaHinhAnh }}')">×</button>
                    </div>
                </div>
                <label for="file-3" class="upload-box-placeholder" style="display: none;">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 3</span>
                </label>
            @else
                <div class="preview-zone" style="display: none;"></div>
                <label for="file-3" class="upload-box-placeholder">
                    <i class="fa-solid fa-plus"></i> <span>Tải lên ảnh 3</span>
                </label>
            @endif
        </div>

    </div>
    
    <div id="deleted-images-container"></div>
</div>

                <x-input type="select" name="trang_thai" label="Trạng thái">
                    <option value="1" {{ $product->TrangThai == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $product->TrangThai == 0 ? 'selected' : '' }}>Ẩn</option>
                </x-input>
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">Cập nhật sản phẩm</x-button>
                <a href="{{ route('admin.products') }}" style="text-decoration: none;">
                    <x-button variant="outline-navy">Quay lại</x-button>
                </a>
            </div>
        </form>
    </div>
    
    <script src="{{ asset('js/product-upload.js') }}"></script>
@endsection