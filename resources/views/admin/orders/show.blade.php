@extends('layouts.admin')

@section('title','Chi tiết đơn hàng')

@section('page-title','Chi tiết đơn hàng')

@section('content')

<link rel="stylesheet" href="{{ asset('css/order.css') }}">

<div class="detail-container">

    <div class="top-action-bar">

        <a href="{{ route('admin.orders') }}">
            <x-button variant="outline-navy">← Quay lại</x-button>
        </a>

        <form
            action="{{ route('admin.orders.update',$order->MaDonHang) }}"
            method="POST"
            class="status-form"
        >
            @csrf
            @method('PUT')

            @php
                $statuses = [
                    0 => 'Chờ xác nhận',
                    1 => 'Đã xác nhận',
                    2 => 'Đang giao',
                    3 => 'Hoàn thành',
                ];
            @endphp

            <select name="TrangThai"
                    class="form-control status-select"
                    required>

                <option value="0"
                    {{ $order->TrangThai == 0 ? 'selected' : '' }}
                    {{ $order->TrangThai > 0 ? 'disabled' : '' }}>
                    Chờ xác nhận
                </option>

                <option value="1"
                    {{ $order->TrangThai == 1 ? 'selected' : '' }}
                    {{ !in_array($order->TrangThai,[0,1]) ? 'disabled' : '' }}>
                    Đã xác nhận
                </option>

                <option value="2"
                    {{ $order->TrangThai == 2 ? 'selected' : '' }}
                    {{ !in_array($order->TrangThai,[1,2]) ? 'disabled' : '' }}>
                    Đang giao
                </option>

            </select>

            @if($order->TrangThai < 2)

                <x-button type="submit">
                    Cập nhật trạng thái
                </x-button>

            @else

                <button
                    type="button"
                    class="btn btn-secondary"
                    disabled>
                    Chờ shipper cập nhật
                </button>

            @endif
        </form>

    </div>

    {{-- THÔNG TIN ĐƠN HÀNG --}}

    <div class="detail-grid">

        <div class="form-group">
            <label class="form-label">Mã đơn hàng</label>
            <input type="text" class="form-control" value="{{ $order->MaDonHang }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Ngày đặt</label>
            <input type="text" class="form-control" value="{{ $order->NgayDatHang }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Ngày thanh toán</label>
            <input type="text" class="form-control" value="{{ $order->NgayThanhToan }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Phương thức thanh toán</label>
            <input type="text" class="form-control" value="{{ $order->PTTT }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Người nhận</label>
            <input type="text" class="form-control" value="{{ $order->TenNguoiNhan }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" value="{{ $order->SoDienThoai }}" readonly>
        </div>

        <div class="form-group full-width">
            <label class="form-label">Địa chỉ giao hàng</label>
            <textarea class="form-control" readonly>{{ $order->DiaChiGiaoHang }}</textarea>
        </div>

    </div>

    {{-- CHI TIẾT SẢN PHẨM --}}

    <h3 class="section-title">Sản phẩm đã mua</h3>

    <div class="table-wrapper">

        <table class="table">

            <thead>
                <tr>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>

            <tbody>

                @php
                    $tongTien = 0;
                @endphp

                @foreach($order->chiTietDonHang as $d)

                    @php
                        $thanhTien = $d->SoLuong * $d->DonGia;
                        $tongTien += $thanhTien;
                    @endphp

                    <tr>
                        <td>{{ $d->MaSanPham }}</td>
                        <td>{{ $d->sanPham->TenSanPham ?? '' }}</td>
                        <td>{{ number_format($d->DonGia) }}đ</td>
                        <td>{{ $d->SoLuong }}</td>
                        <td>{{ number_format($thanhTien) }}đ</td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- TỔNG TIỀN --}}

    <div class="order-summary">

        <div>
            Tạm tính:
            <b>{{ number_format($tongTien) ?? 0}}đ</b>
        </div>

        <div>
            Giảm giá:
            <b>{{ number_format($order->GiaTriApDung) ?? 0}}đ</b>
        </div>

        <div class="final-total">
            Tổng thanh toán:
            <b>{{ number_format($tongTien - ($order->GiaTriApDung ?? 0)) }}đ</b>
        </div>

    </div>

</div>

@endsection