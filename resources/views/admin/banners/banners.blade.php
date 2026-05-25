@extends('layouts.admin')

@section('title','Banner')

@section('page-title')

Quản lý banner

@endsection

@section('content')

    <div class="page-header">
        <h3>Danh sách banner</h3>
        <a href="{{ route('admin.addBanner') }}">
            <x-button variant="primary">
                <i class="fa-solid fa-plus"></i>
                Thêm banner
            </x-button>
        </a>
    </div>

    <x-table
        :headers="['STT', 'Mã banner', 'Tên banner', 'Hình ảnh', 'Trạng thái', 'Thao tác']"
        striped
    >
        @foreach($banners as $index => $banner)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $banner->MaBanner }}</td>
            <td>{{ $banner->TenBanner }}</td>
            <td><img src="{{ asset('images/banner/' . $banner->HinhAnh) }}" alt="" style="width: 180px; height: 100px; object-fit: cover; border-radius: 8px;"></td>
            <td>{{ $banner->TrangThai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="{{ route('admin.editBanner', $banner->MaBanner) }}">
                        <x-button>
                            <i class="fa-solid fa-pen-to-square"></i>
                            Sửa
                        </x-button>
                    </a>
                    <form action="{{ route('admin.deleteBanner', $banner->MaBanner) }}" 
                    method="POST" 
                    onsubmit="return confirm('Bạn có chắc muốn xóa banner này?')">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" variant="danger">
                            <i class="fa-solid fa-trash"></i>
                            Xóa
                        </x-button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </x-table>

@endsection