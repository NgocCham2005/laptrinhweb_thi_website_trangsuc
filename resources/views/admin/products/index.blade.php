@extends('layouts.admin')

@section('title','Sản phẩm')

@section('page-title')
Quản lý sản phẩm
@endsection

@section('content')
    <div class="page-header">
        <h3>Danh sách sản phẩm</h3>
        <a href="{{ route('admin.addProduct') }}">
            <x-button variant="primary">Thêm sản phẩm</x-button>
        </a>
    </div>
    
    <x-table :headers="['Mã SP', 'Hình ảnh', 'Tên sản phẩm', 'Danh mục', 'Giá bán', 'Trạng thái', 'Thao tác']" striped>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->MaSanPham }}</td>
            <td>
                @if($product->images->first())
                <img src="{{ asset('images/product/' . $product->first_image) }}" 
                            alt="Ảnh sản phẩm" class="img-product-admin">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>
            <td>{{ $product->TenSanPham }}</td>
            <td>{{ $product->category->TenDanhMuc ?? 'Trống' }}</td>
            <td>{{ number_format($product->GiaBan, 0, ',', '.') }}đ</td>
            <td>
                @if($product->TrangThai == 1) <x-badge variant="success">Hiển thị</x-badge>
                @else <x-badge variant="warning">Ẩn</x-badge>
                @endif
            </td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="{{ route('admin.editProduct', $product->MaSanPham) }}">
                        <x-button>Sửa</x-button>
                    </a>
                    <x-button variant="danger" type="button" onclick="openModal('deleteProduct{{ $product->MaSanPham }}')">
                        Xóa
                    </x-button>
                </div>
            </td>
        </tr>

        <x-modal id="deleteProduct{{ $product->MaSanPham }}" title="Xác nhận xóa sản phẩm">
            Bạn có chắc chắn muốn xóa sản phẩm <b>{{ $product->TenSanPham }}</b> ?
            <br>
            <small class="text-danger">* Lưu ý: Nếu sản phẩm đã được mua, hệ thống sẽ tự động chuyển sang trạng thái ẨN.</small>
            <x-slot:footer>
                <form action="{{ route('admin.deleteProduct', $product->MaSanPham) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button variant="danger" type="submit">Xác nhận</x-button>
                    <x-button type="button" variant="ghost" onclick="closeModal('deleteProduct{{ $product->MaSanPham }}')">Hủy</x-button>
                </form>
            </x-slot:footer>
        </x-modal>
        @endforeach
    </x-table>

    <x-pagination :paginator="$products"/>
@endsection