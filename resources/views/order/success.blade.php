@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/success.css') }}">

<div class="success-wrap">

    {{-- ── Header ── --}}
    <div class="success-header">
        <span class="success-icon">✅</span>
        <h1>Đặt hàng thành công!</h1>
        <p>Cảm ơn bạn đã tin tưởng Luminous Jewelry.<br>Chúng tôi sẽ xử lý đơn hàng sớm nhất có thể.</p>
        <div class="success-order-id">{{ $donHang->MaDonHang }}</div>
    </div>

    {{-- ── Hướng dẫn chuyển khoản (chỉ hiện nếu CK) ── --}}
    @if($donHang->PTTT === 'CK')
        <div class="success-card">
            <div class="success-card-title">🏦 Hướng dẫn chuyển khoản</div>
            <div class="ck-box">
                <div class="ck-title">⚠️ Vui lòng chuyển khoản để hoàn tất đơn hàng</div>
                🏦 <strong>Ngân hàng:</strong> Vietcombank<br>
                📋 <strong>Số tài khoản:</strong>
                    <span class="ck-highlight">1234567890</span><br>
                👤 <strong>Chủ tài khoản:</strong> NGUYEN VAN A<br>
                📝 <strong>Nội dung CK:</strong>
                    <span class="ck-highlight">
                        {{ $donHang->MaDonHang }} - {{ $donHang->TenNguoiNhan }}
                    </span>
                <div class="ck-warn">
                    ⚠️ Đơn hàng sẽ được xác nhận sau khi admin nhận được tiền.
                </div>
            </div>
        </div>
    @endif

    {{-- ── Thông tin đơn hàng ── --}}
    <div class="success-card">
        <div class="success-card-title">📋 Thông tin đơn hàng</div>
        <div class="info-grid">

            <div class="info-item">
                <label>Mã đơn hàng</label>
                <span>{{ $donHang->MaDonHang }}</span>
            </div>

            <div class="info-item">
                <label>Ngày đặt</label>
                <span>{{ \Carbon\Carbon::parse($donHang->NgayDatHang)->format('d/m/Y H:i') }}</span>
            </div>

           <div class="info-item">
    <label>Trạng thái</label>
@php
    $trangThaiMap = [
        0 => [
            'label' => 'Chờ xác nhận',
            'class' => 'status-0'
        ],
        1 => [
            'label' => 'Đã xác nhận',
            'class' => 'status-1'
        ],
        2 => [
            'label' => 'Đang giao',
            'class' => 'status-2'
        ],
        3 => [
            'label' => 'Hoàn thành',
            'class' => 'status-3'
        ],
        4 => [
            'label' => 'Đã hủy',
            'class' => 'status-4'
        ],
    ];

    $tt = $trangThaiMap[$donHang->TrangThai] ?? $trangThaiMap[0];
@endphp

<span class="status-badge {{ $tt['class'] }}">
    {{ $tt['label'] }}
</span>
</div>

            <div class="info-item">
                <label>Phương thức thanh toán</label>
                <span class="pttt-badge {{ $donHang->PTTT === 'COD' ? 'pttt-cod' : 'pttt-ck' }}">
                    {{ $donHang->PTTT === 'COD' ? '🚚 Tiền mặt (COD)' : '🏦 Chuyển khoản' }}
                </span>
            </div>

            <div class="info-item">
                <label>Người nhận</label>
                <span>{{ $donHang->TenNguoiNhan }}</span>
            </div>

            <div class="info-item">
                <label>Số điện thoại</label>
                <span>{{ $donHang->SoDienThoai }}</span>
            </div>

            <div class="info-item info-full">
                <label>Địa chỉ giao hàng</label>
                <span>{{ $donHang->DiaChiGiaoHang }}</span>
            </div>

        </div>
    </div>

    {{-- ── Chi tiết sản phẩm ── --}}
    <div class="success-card">
        <div class="success-card-title">🧾 Chi tiết sản phẩm</div>

        @foreach($donHang->chiTietDonHang as $item)
            <div class="order-item">
                <div class="order-item-info">
                    @if($item->sanPham)
                        <a href="{{ route('products.detail', $item->MaSanPham) }}" class="order-item-name-link">
                            <div class="order-item-name">{{ $item->sanPham->TenSanPham }}</div>
                        </a>
                        <div class="order-item-qty">x{{ $item->SoLuong }} × {{ number_format($item->DonGia) }}đ</div>
                        <a href="{{ route('products.detail', $item->MaSanPham) }}" class="order-item-detail-link">
                            Xem chi tiết sản phẩm
                        </a>
                    @else
                        <div class="order-item-name">Sản phẩm không còn tồn tại</div>
                        <div class="order-item-qty">x{{ $item->SoLuong }} × {{ number_format($item->DonGia) }}đ</div>
                    @endif
                </div>
                <div class="order-item-price">
                    {{ number_format($item->SoLuong * $item->DonGia) }}đ
                </div>
            </div>
        @endforeach

        @php
            $tamTinh  = $donHang->chiTietDonHang->sum(fn($i) => $i->SoLuong * $i->DonGia);
            $giam     = $donHang->GiaTriApDung ?? 0;
            $tongCuoi = $tamTinh - $giam;
        @endphp

        <hr class="summary-divider">

        <div class="summary-row">
            <span>Tạm tính</span>
            <span>{{ number_format($tamTinh) }}đ</span>
        </div>

        @if($giam > 0)
            <div class="summary-row discount">
                <span>🎟️ Giảm giá ({{ $donHang->MaVoucher }})</span>
                <span>-{{ number_format($giam) }}đ</span>
            </div>
        @endif

        <div class="summary-row free">
            <span>Phí giao hàng</span>
            <span>0đ</span>
        </div>

        <div class="summary-row total">
            <span>Tổng cộng</span>
            <span>{{ number_format($tongCuoi) }}đ</span>
        </div>

    </div>

   {{-- ── Đánh giá sản phẩm (chỉ hiện khi đơn hoàn thành) ── --}}
    @if($donHang->TrangThai == 3)
        <div class="success-card">
            <div class="success-card-title">⭐ Đánh giá sản phẩm</div>
            <p style="margin: 0 0 12px; color: #666; font-size: 0.9rem;">
                Đơn hàng đã hoàn thành! Hãy chia sẻ cảm nhận của bạn về sản phẩm nhé.
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                @foreach($donHang->chiTietDonHang as $item)
                    @if($item->sanPham)
                        <a href="{{ route('review.create', [$item->MaSanPham, $donHang->MaDonHang]) }}">
                            <x-button variant="outline-navy" size="sm">
                                ⭐ {{ Str::limit($item->sanPham->TenSanPham, 20) }}
                            </x-button>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

   {{-- ── Nút điều hướng ── --}}
<div class="success-actions">
    <x-button variant="outline-navy" onclick="location.href='{{ route('products.index') }}'">
        ← Tiếp tục mua sắm
    </x-button>
    <x-button variant="secondary" onclick="location.href='{{ route('order.lichSu') }}'">
        Xem lịch sử đơn hàng
    </x-button>
</div>

</div>

@endsection