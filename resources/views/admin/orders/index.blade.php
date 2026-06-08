@extends('layouts.admin')

@section('title','Đơn hàng')

@section('page-title','Quản lý đơn hàng')

@section('content')

<link rel="stylesheet" href="{{ asset('css/order.css') }}">

{{-- SEARCH + FILTER --}}

<div class="filter-bar">
    <form method="GET" class="filter-form">

        <input
            type="text"
            name="keyword"
            class="form-control search-box"
            placeholder="Tìm mã đơn / người nhận"
            value="{{ request('keyword') }}"
        >

    <select name="status" class="form-control status-filter">
        <option value="">Tất cả trạng thái</option>

        <option value="0" {{ request('status')==='0' ? 'selected':'' }}>
            Chờ xác nhận
        </option>

        <option value="1" {{ request('status')==='1' ? 'selected':'' }}>
            Đã xác nhận
        </option>

        <option value="2" {{ request('status')==='2' ? 'selected':'' }}>
            Đang giao
        </option>

        <option value="3" {{ request('status')==='3' ? 'selected':'' }}>
            Thành công
        </option>

        <option value="4" {{ request('status')==='4' ? 'selected':'' }}>
            Không thành công
        </option>
    </select>

        <x-button type="submit">Lọc</x-button>

    </form>
</div>

{{-- TABLE --}}

<x-table :headers="[
    'Mã đơn',
    'Ngày đặt',
    'Người nhận',
    'Tổng tiền',
    'Trạng thái',
    'Chi tiết'
]">

@forelse($orders as $o)

<tr>
    <td>{{ $o->MaDonHang }}</td>
    <td>{{ $o->NgayDatHang }}</td>
    <td>{{ $o->TenNguoiNhan }}</td>

    <td>
        {{ number_format($o->TongThanhToan) }}đ
    </td>

    <td>
        @switch($o->TrangThai)

            @case(0)
                <x-badge variant="warning">Chờ xác nhận</x-badge>
            @break

            @case(1)
                <x-badge variant="info">Đã xác nhận</x-badge>
            @break

            @case(2)
                <x-badge variant="gold">Đang giao</x-badge>
            @break

            @case(3)
                <x-badge variant="success">Thành công</x-badge>
            @break

            @case(4)
                <x-badge variant="danger">Không thành công</x-badge>
            @break

        @endswitch
    </td>

    <td>
        <a href="{{ route('admin.orders.show', $o->MaDonHang) }}">
            <x-button>Xem chi tiết</x-button>
        </a>
    </td>
</tr>

@empty

<tr>
    <td colspan="6" class="text-center">
        Không có dữ liệu
    </td>
</tr>

@endforelse

</x-table>

@if($orders->count())
    <x-pagination :paginator="$orders"/>
@endif

@endsection