@extends('layouts.admin')

@section('title','Danh mục sản phẩm')

@section('page-title')
Quản lý danh mục sản phẩm
@endsection

@section('content')
    <div class="page-header">
        <h3>Danh sách danh mục sản phẩm</h3>
        <a href="{{ route('admin.createCategory') }}" class="btn btn-primary">
            Thêm danh mục
        </a>
    </div>

    <x-table :headers="['Mã danh mục', 'Tên danh mục', 'Hình ảnh', 'Trạng thái', 'Thao tác']" striped>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->MaDanhMuc }}</td>
            <td>{{ $category->TenDanhMuc }}</td>
            <td><img src="{{ asset('images/categories/' . $category->HinhAnh) }}" alt="{{ $category->TenDanhMuc ?? 'Ảnh danh mục' }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px;"</td>
            <td>
                @if(isset($category->TrangThai) && $category->TrangThai == 1)
                    <x-badge variant="success">Hiển thị</x-badge>
                @else
                    <x-badge variant="warning">Ẩn</x-badge>
                @endif
            </td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="{{ route('admin.editCategory', $category->MaDanhMuc) }}">
                        <x-button>Sửa</x-button>
                    </a>
                    <x-button variant="danger" type="button" onclick="openModal('destroyCategory{{ $category->MaDanhMuc }}')">
                        Xóa
                    </x-button>
                </div>
            </td>
        </tr>
        <x-modal id="destroyCategory{{ $category->MaDanhMuc }}" title="Xác nhận xóa danh mục">
        Bạn có chắc chắn muốn xóa danh mục <b>{{ $category->TenDanhMuc }}</b>? 
        <br>
        <small class="text-danger">* Lưu ý: Nếu danh mục đang chứa sản phẩm, hệ thống sẽ tự động chuyển sang trạng thái ẨN.</small>

        <x-slot:footer>
            <form action="{{ route('admin.deleteCategory', $category->MaDanhMuc) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-button variant="danger" type="submit">Xác nhận</x-button>
                <x-button type="button" variant="ghost" onclick="closeModal('destroyCategory{{ $category->MaDanhMuc }}')">Hủy</x-button>
            </form>
        </x-slot:footer>
        </x-modal>
        @endforeach
    </x-table>
    <x-pagination :paginator="$categories"/>
@endsection