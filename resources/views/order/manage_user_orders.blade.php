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
            <a href="{{ route('products.index') }}">
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
                    $trangThaiMap = [
                        0 => ['class' => 'status-0', 'label' => 'Chờ xác nhận'],
                        1 => ['class' => 'status-1', 'label' => 'Đã xác nhận'],
                        2 => ['class' => 'status-2', 'label' => 'Đang giao'],
                        3 => ['class' => 'status-3', 'label' => 'Hoàn thành'],
                        4 => ['class' => 'status-4', 'label' => 'Đã hủy'],
                    ];
                    $tt = $trangThaiMap[$dh->TrangThai] ?? $trangThaiMap[0];
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
                            <span class="status-badge {{ $tt['class'] }}">{{ $tt['label'] }}</span>
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
                            <div style="display:flex; flex-direction:column; gap:8px; align-items:flex-end;">
                                <a href="{{ route('order.chiTiet', $dh->MaDonHang) }}">
                                    <x-button variant="outline-navy" size="sm">Xem chi tiết →</x-button>
                                </a>

                                {{-- Nút hủy — chỉ hiện khi Chờ xác nhận --}}
                                @if($dh->TrangThai == 0)
                                    <x-button variant="danger" size="sm"
                                        onclick="openModal('modal-huy-{{ $dh->MaDonHang }}')">
                                        Hủy đơn
                                    </x-button>
                                @endif

                                {{-- Nút đánh giá — chỉ hiện khi Hoàn thành --}}
                                @if($dh->TrangThai == 3)
                                    <div style="display:flex; flex-wrap:wrap; gap:6px; justify-content:flex-end;">
                                        @foreach($dh->chiTietDonHang as $item)
                                            @if($item->sanPham)
                                                <a href="{{ route('review.create', [$item->MaSanPham, $dh->MaDonHang]) }}">
                                                    <x-button variant="outline-navy" size="sm">⭐ {{ Str::limit($item->sanPham->TenSanPham, 20) }}</x-button>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- ── Modal hủy đơn — đặt NGOÀI vòng lặp card ── --}}
        @foreach($donHangs as $dh)
            @if($dh->TrangThai == 0)
                <x-modal id="modal-huy-{{ $dh->MaDonHang }}" title="Xác nhận hủy đơn hàng">
                    <p>Bạn có chắc muốn hủy đơn hàng <strong>{{ $dh->MaDonHang }}</strong> không?</p>
                    <p style="margin-top:8px; font-size:13px; color:#888;">
                        Sau khi hủy, tồn kho sẽ được hoàn lại và thao tác này không thể hoàn tác.
                    </p>
                    <x-slot name="footer">
                        <x-button variant="ghost" onclick="closeModal('modal-huy-{{ $dh->MaDonHang }}')">Không</x-button>
                        <form action="{{ route('order.huy', $dh->MaDonHang) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-button type="submit" variant="danger">Xác nhận hủy</x-button>
                        </form>
                    </x-slot>
                </x-modal>
            @endif
        @endforeach

        {{-- Phân trang --}}
        <div class="lich-su-pagination">
            {{ $donHangs->links() }}
        </div>
    @endif

</div>

@endsection