@extends('layouts.admin')

@section('title', 'Khách hàng')

@section('page-title', 'Quản lý khách hàng')

@section('content')

{{-- HEADER --}}
<div class="page-header">
    <h3>Danh sách khách hàng</h3>
</div>

{{-- SEARCH --}}
<form method="GET" action="/admin/customers" style="margin-bottom: 16px; display: flex; gap: 10px;">
    <input
        type="text"
        name="keyword"
        class="form-control"
        placeholder="Tìm theo mã, tên, username, email..."
        value="{{ request('keyword') }}"
        style="max-width: 360px;"
    >
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

{{-- TABLE --}}
<x-table
    :headers="['Mã TK', 'Họ tên', 'Tên đăng nhập', 'Email', 'Trạng thái', 'Thao tác']"
    striped
>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->MaTaiKhoan }}</td>
            <td>{{ $user->HoTen }}</td>
            <td>{{ $user->TenDangNhap }}</td>
            <td>{{ $user->Email }}</td>
            <td>
                @if($user->TrangThai == 1)
                    <span class="badge badge-success">Hoạt động</span>
                @else
                    <span class="badge badge-danger">Đã khóa</span>
                @endif
            </td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="/admin/customers/{{ $user->MaTaiKhoan }}">
                        <x-button>Chi tiết</x-button>
                    </a>
                    <a href="/admin/customers/toggle/{{ $user->MaTaiKhoan }}">
                        <x-button variant="danger">
                            {{ $user->TrangThai == 1 ? 'Khóa' : 'Mở khóa' }}
                        </x-button>
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" style="text-align: center; color: #94a3b8;">Không có dữ liệu</td>
        </tr>
    @endforelse
</x-table>

@endsection