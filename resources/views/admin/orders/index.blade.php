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
            <option value="0" {{ request('status')==='0' ? 'selected':'' }}>Chờ xác nhận</option>
            <option value="1" {{ request('status')==='1' ? 'selected':'' }}>Đã xác nhận</option>
            <option value="2" {{ request('status')==='2' ? 'selected':'' }}>Đang giao</option>
            <option value="3" {{ request('status')==='3' ? 'selected':'' }}>Hoàn thành</option>
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

@foreach($orders as $o)

<tr>
    <td>{{ $o->MaDonHang }}</td>
    <td>{{ $o->NgayDatHang }}</td>
    <td>{{ $o->TenNguoiNhan }}</td>

    <td>   
        {{ number_format($o->TongThanhToan) }}đ
    </td>

    <td>
        @if($o->TrangThai == 0)
            <x-badge variant="warning">Chờ xác nhận</x-badge>
        @elseif($o->TrangThai == 1)
            <x-badge variant="info">Đã xác nhận</x-badge>
        @elseif($o->TrangThai == 2)
            <x-badge variant="gold">Đang giao</x-badge>
        @else
            <x-badge variant="success">Hoàn thành</x-badge>
        @endif
    </td>

    <td>
        <a href="{{ route('admin.orders.show', $o->MaDonHang) }}">
            <x-button>Xem chi tiết</x-button>
        </a>
    </td>
</tr>

@endforeach

</x-table>

<x-pagination :paginator="$orders"/>

@endsection