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
                Thêm banner
            </x-button>
        </a>
    </div>

    <x-table
        :headers="['Mã banner', 'Tên banner', 'Hình ảnh', 'Trạng thái', 'Thao tác']"
        striped
    >
        @foreach($banners as $index => $banner)
        <tr>
            <td>{{ $banner->MaBanner }}</td>
            <td>{{ $banner->TenBanner }}</td>
            <td><img src="{{ asset('images/banners/' . $banner->HinhAnh) }}" alt="" style="width: 180px; height: 100px; object-fit: cover; border-radius: 8px;"></td>
            <td>
                @if($banner->TrangThai == 1) <x-badge variant="success">Hiển thị</x-badge>
                @else <x-badge variant="warning">Ẩn</x-badge>
                @endif
            </td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="{{ route('admin.editBanner', $banner->MaBanner) }}">
                        <x-button>
                            Sửa
                        </x-button>
                    </a>
                    <x-button variant="danger" type="button" onclick="openModal('deleteBanner{{ $banner->MaBanner }}')">
                        Xóa
                    </x-button>
                </div>
            </td>
        </tr>
        <x-modal id="deleteBanner{{ $banner->MaBanner }}" title="Xác nhận xóa banner">
            Bạn có chắc chắn muốn xóa banner <b>{{ $banner->TenBanner }}</b> ?
            <x-slot:footer>
                <form action="{{ route('admin.deleteBanner', $banner->MaBanner) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button variant="danger" type="submit">Xác nhận</x-button>
                    <x-button type="button" variant="ghost" onclick="closeModal('deleteBanner{{ $banner->MaBanner }}')">Hủy</x-button>
                </form>
            </x-slot:footer>
        </x-modal>
        @endforeach
    </x-table>

    <x-pagination :paginator="$banners"/>

@endsection