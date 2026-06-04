
@extends('layouts.admin')

@section('content')

@php
    $orders = DB::table('Don_Hang')
        ->where('MaTaiKhoan', $user->MaTaiKhoan)
        ->orderBy('NgayDatHang', 'desc')
        ->get();
@endphp

<div class="ud-wrapper">

    {{-- HEADER --}}
    <div class="ud-header">
        <div class="ud-header-left">
            <a href="/admin/customers" class="ud-back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
                Quay lại
            </a>
            <div>
                <h2 class="ud-title">Chi tiết khách hàng</h2>
                <p class="ud-subtitle">{{ $user->MaTaiKhoan }}</p>
            </div>
        </div>
        <span class="ud-status-badge {{ $user->TrangThai == 1 ? 'ud-status-active' : 'ud-status-locked' }}">
            {{ $user->TrangThai == 1 ? 'Hoạt động' : 'Đã khóa' }}
        </span>
    </div>

    <div class="ud-body">

        {{-- THÔNG TIN KHÁCH HÀNG --}}
        <div class="ud-card ud-info-card">
            <div class="ud-card-head">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Thông tin tài khoản
            </div>
            <div class="ud-card-body">
                <div class="ud-avatar">
                    {{ mb_substr($user->HoTen, 0, 1) }}
                </div>
                <div class="ud-info-grid">
                    <div class="ud-info-item">
                        <span class="ud-info-label">Mã tài khoản</span>
                        <span class="ud-info-value ud-mono">{{ $user->MaTaiKhoan }}</span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Họ tên</span>
                        <span class="ud-info-value">{{ $user->HoTen }}</span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Tên đăng nhập</span>
                        <span class="ud-info-value ud-mono">{{ $user->TenDangNhap }}</span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Email</span>
                        <span class="ud-info-value">{{ $user->Email }}</span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Số điện thoại</span>
                        <span class="ud-info-value">{{ $user->SoDienThoai }}</span>
                    </div>
                    <div class="ud-info-item">
                        <span class="ud-info-label">Địa chỉ</span>
                        <span class="ud-info-value">{{ $user->DiaChi }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- LỊCH SỬ ĐƠN HÀNG --}}
        <div class="ud-card ud-orders-card">
            <div class="ud-card-head">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="2"/>
                </svg>
                Lịch sử đơn hàng
                <span class="ud-order-count">{{ count($orders) }} đơn</span>
            </div>
            <div class="ud-card-body ud-no-pad">
                @if(count($orders) > 0)
                <table class="ud-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Người nhận</th>
                            <th>Địa chỉ giao</th>
                            <th>PTTT</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><span class="ud-mono ud-order-id">{{ $order->MaDonHang }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($order->NgayDatHang)->format('d/m/Y') }}</td>
                            <td>{{ $order->TenNguoiNhan }}</td>
                            <td>{{ $order->DiaChiGiaoHang }}</td>
                            <td>{{ $order->PTTT }}</td>
                            <td>
                                @php
                                    $trangThai = $order->TrangThai;
                                    $labelMap = [
                                        0 => ['text' => 'Chờ xác nhận', 'class' => 'ud-badge-pending'],
                                        1 => ['text' => 'Đang xử lý',   'class' => 'ud-badge-processing'],
                                        2 => ['text' => 'Đang giao',    'class' => 'ud-badge-shipping'],
                                        3 => ['text' => 'Đã giao',      'class' => 'ud-badge-done'],
                                        4 => ['text' => 'Đã hủy',       'class' => 'ud-badge-cancel'],
                                    ];
                                    $info = $labelMap[$trangThai] ?? ['text' => 'Không rõ', 'class' => 'ud-badge-pending'];
                                @endphp
                                <span class="ud-badge {{ $info['class'] }}">{{ $info['text'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="ud-empty">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v4M12 16h.01"/>
                    </svg>
                    <p>Khách hàng chưa có đơn hàng nào</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>


@endsection