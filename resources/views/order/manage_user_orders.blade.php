@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/manage_user_orders.css') }}">

<div class="lich-su-wrap">

    <h1 class="lich-su-heading">📦 Lịch sử đơn hàng</h1>

    {{-- ── Trống ── --}}
    @if($donHangs->isEmpty())
        <div class="lich-su-empty">
            <span class="lich-su-empty-icon">🛍️</span>
            <h3>Chưa có đơn hàng nào</h3>
            <p>Bạn chưa thực hiện đơn hàng nào. Hãy khám phá bộ sưu tập của chúng tôi!</p>
            <a href="{{ url('/san-pham') }}">
                <x-button variant="primary">Mua sắm ngay</x-button>
            </a>
        </div>

    {{-- ── Danh sách ── --}}
    @else
        <div class="don-hang-list">
            @foreach($donHangs as $dh)
                @php
                    $tamTinh  = $dh->chiTietDonHang->sum(fn($i) => $i->SoLuong * $i->DonGia);
                    $giam     = $dh->GiaTriApDung ?? 0;
                    $tongCuoi = $tamTinh - $giam;
                    $spHien   = $dh->chiTietDonHang->take(2);
                    $conLai   = $dh->chiTietDonHang->count() - 2;
                @endphp

                <div class="don-hang-card">

                    {{-- Header --}}
                    <div class="don-hang-header">
                        <div>
                            <div class="don-hang-ma">{{ $dh->MaDonHang }}</div>
                            <div class="don-hang-ngay">
                                {{ \Carbon\Carbon::parse($dh->NgayDatHang)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                        <div class="don-hang-header-right">
                            <span class="pttt-badge {{ $dh->PTTT === 'COD' ? 'pttt-cod' : 'pttt-ck' }}">
                                {{ $dh->PTTT === 'COD' ? '🚚 COD' : '🏦 Chuyển khoản' }}
                            </span>
                            <span class="status-badge status-{{ $dh->TrangThai }}">
                                {{ $dh->TrangThai == 0 ? '⏳ Chờ xác nhận' : '✅ Đã xác nhận' }}
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="don-hang-body">

                        {{-- Tóm tắt SP --}}
                        <div class="don-hang-sp-list">
                            @foreach($spHien as $item)
                                <div class="don-hang-sp-item">
                                    <span class="sp-dot"></span>
                                    <span class="don-hang-sp-name">
                                        {{ $item->sanPham->TenSanPham ?? 'Sản phẩm không còn tồn tại' }}
                                    </span>
                                    <span class="don-hang-sp-qty">x{{ $item->SoLuong }}</span>
                                </div>
                            @endforeach
                            @if($conLai > 0)
                                <div class="don-hang-sp-more">+ {{ $conLai }} sản phẩm khác...</div>
                            @endif
                        </div>

                        {{-- Tổng + nút --}}
                        <div class="don-hang-right">
                            <div>
                                <div class="don-hang-tong-label">Tổng cộng</div>
                                <div class="don-hang-tong-gia">{{ number_format($tongCuoi) }}đ</div>
                            </div>
                            <a href="{{ route('order.chiTiet', $dh->MaDonHang) }}">
                                <x-button variant="outline-navy" size="sm">
                                    Xem chi tiết →
                                </x-button>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Phân trang --}}
        <div class="lich-su-pagination">
            {{ $donHangs->links() }}
        </div>
    @endif

</div>

@endsection