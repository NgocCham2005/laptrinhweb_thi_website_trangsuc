@extends('layouts.app')

@section('content')


{{-- CSS riêng cho trang checkout --}}
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="checkout-wrap">

    {{-- ── Tiêu đề ── --}}
    <h1 class="checkout-heading">
    🛒 Thanh toán
</h1>

    {{-- ── Step indicator ── --}}
    <div class="checkout-steps">
        <div class="step active">
            <span class="step-num">1</span>
            <span>Thanh toán</span>
        </div>
        <div class="step-sep"></div>
        <div class="step">
            <span class="step-num">2</span>
            <span>Xác nhận</span>
        </div>
    </div>

    {{-- ── Alert lỗi ── --}}
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom:20px;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('order.datHang') }}" method="POST" id="form-order">
        @csrf
        <input type="hidden" name="NguonDat"   value="{{ $nguonDat }}">
        <input type="hidden" name="MaVoucher"  id="input-ma-voucher">
        <input type="hidden" name="GiaTriGiam" id="input-gia-tri-giam" value="0">

        <div class="checkout-grid">

            {{-- ════════════════════════════════
                 CỘT TRÁI
            ════════════════════════════════ --}}
            <div>

                {{-- Thông tin giao hàng --}}
                <div class="checkout-card">
                    <div class="checkout-card-title">📦 Thông tin giao hàng</div>

                    <x-input
                        name="TenNguoiNhan"
                        label="Họ tên người nhận"
                        placeholder="Nguyễn Văn A"
                        icon="👤"
                        :value="old('TenNguoiNhan')"
                    />

                    <x-input
                        name="SoDienThoai"
                        label="Số điện thoại"
                        type="tel"
                        placeholder="0912 345 678"
                        icon="📞"
                        :value="old('SoDienThoai')"
                    />

                    <x-input
                        name="DiaChiGiaoHang"
                        label="Địa chỉ giao hàng"
                        type="textarea"
                        placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành..."
                        :rows="3"
                        :value="old('DiaChiGiaoHang')"
                    />
                </div>

                {{-- Phương thức thanh toán --}}
                <div class="checkout-card">
                    <div class="checkout-card-title">💳 Phương thức thanh toán</div>

                    <div class="pttt-group">
                        <label class="pttt-option active" id="opt-cod">
                            <input type="radio" name="PTTT" value="COD" checked>
                            <span class="icon">🚚</span>
                            <span class="lbl">Tiền mặt (COD)</span>
                        </label>
                        <label class="pttt-option" id="opt-ck">
                            <input type="radio" name="PTTT" value="CK">
                            <span class="icon">🏦</span>
                            <span class="lbl">Chuyển khoản</span>
                        </label>
                    </div>

                    @error('PTTT')
                        <div class="form-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                    <div class="ck-box" id="ck-info">
                        <span class="ck-label">Thông tin tài khoản</span>
                        <div>
                            🏦 <strong>Ngân hàng:</strong> Vietcombank<br>
                            📋 <strong>Số tài khoản:</strong> 1234567890<br>
                            👤 <strong>Chủ tài khoản:</strong> NGUYEN VAN A<br>
                            📝 <strong>Nội dung CK:</strong>
                            <span id="ck-noidung" style="color:var(--gold);font-weight:700">[Tên] + [SĐT]</span>
                        </div>
                        <div class="ck-qr">
                            <img
                                src="https://img.vietqr.io/image/VCB-1234567890-compact2.png?amount=0&addInfo=DatHang&accountName=NGUYEN+VAN+A"
                                alt="QR chuyển khoản"
                                id="ck-qr-img"
                                onerror="this.style.display='none'"
                            >
                            <p>Quét mã QR để chuyển khoản nhanh</p>
                        </div>
                        <div class="ck-warn">
                            ⚠️ Đơn hàng sẽ được xác nhận sau khi admin nhận được tiền.
                        </div>
                    </div>
                </div>

            </div>{{-- end cột trái --}}

            {{-- ════════════════════════════════
                 CỘT PHẢI — Tóm tắt đơn hàng
            ════════════════════════════════ --}}
            <div>
                <div class="checkout-card">
                    <div class="checkout-card-title">🧾 Đơn hàng của bạn</div>

                    {{-- Danh sách sản phẩm --}}
                    @foreach($chiTiet as $item)
                        <div class="order-item">
                            <div class="order-item-info">
                                <div class="order-item-name">{{ $item->sanPham->TenSanPham }}</div>
                                <div class="order-item-qty">x{{ $item->SoLuong }}</div>
                            </div>
                            <div class="order-item-price">
                                {{ number_format($item->SoLuong * $item->sanPham->GiaBan) }}đ
                            </div>
                        </div>
                    @endforeach

                    {{-- Voucher --}}
                    @if($vouchers->count() > 0)
                        <div class="voucher-wrap">
                            <span class="voucher-label-text">🎟️ Chọn voucher giảm giá</span>

                            <div class="voucher-selector" id="voucher-selector"
                                 onclick="toggleVoucherDropdown()">
                                <span id="voucher-label" style="color:var(--gray-400)">
                                    -- Chọn voucher --
                                </span>
                                <span class="voucher-chevron" id="voucher-chevron">▼</span>
                            </div>

                            <div class="voucher-dropdown" id="voucher-dropdown">

                                <div class="vd-item none-opt" onclick="selectVoucher(null)">
                                    Không dùng voucher
                                </div>

                                @foreach($vouchers as $v)
                                    @php
                                        $valid = $tongTien >= (float) $v->DieuKien;
                                        $giam  = (int) $v->GiaTriGiamToiDa;
                                    @endphp

                                    <div class="vd-item {{ $valid ? 'clickable' : 'disabled' }}"
                                        @if($valid)
                                            onclick="selectVoucher('{{ $v->MaVoucher }}', {{ $giam }}, '{{ addslashes($v->TenVoucher ?? $v->MaVoucher) }}')"
                                        @endif
                                    >
                                        <div class="vd-row">
                                            <div>
                                                <span class="vd-code {{ $valid ? '' : 'dim' }}">{{ $v->MaVoucher }}</span>
                                                @if(!empty($v->TenVoucher))
                                                    <span class="vd-name">{{ $v->TenVoucher }}</span>
                                                @endif
                                            </div>
                                            <span class="vd-saving {{ $valid ? '' : 'dim' }}">
                                                -{{ number_format($giam) }}đ
                                            </span>
                                        </div>
                                        <div class="vd-note {{ $valid ? 'ok' : '' }}">
                                            @if($valid)
                                                ✅ Áp dụng được cho đơn này
                                            @else
                                                ⛔ Đơn tối thiểu {{ number_format($v->DieuKien) }}đ
                                            @endif
                                        </div>
                                        @if(!empty($v->NgayHetHan))
                                        <div class="vd-note ok">
                                        🕒 HSD: {{ \Carbon\Carbon::parse($v->NgayHetHan)->format('d/m/Y') }}
                                        </div>
                                        @endif
                                    </div>
                                @endforeach

                            </div>{{-- end dropdown --}}

                            <div class="voucher-msg" id="voucher-msg"></div>
                        </div>
                    @else
                        <p class="no-voucher">Không có voucher khả dụng</p>
                    @endif

                    {{-- Tổng tiền --}}
                    <hr class="summary-divider">

                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span>{{ number_format($tongTien) }}đ</span>
                    </div>

                    <div class="summary-row discount" id="row-giam" style="display:none;">
                        <span>🎟️ Giảm giá (voucher)</span>
                        <span id="txt-giam">-0đ</span>
                    </div>

                    <div class="summary-row free">
                        <span>Phí giao hàng</span>
                        <span>0đ</span>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng cộng</span>
                        <span class="summary-total-price" id="txt-tong">
                            {{ number_format($tongTien) }}đ
                        </span>
                    </div>

                    <x-button
                        type="submit"
                        variant="primary"
                        :block="true"
                        size="lg"
                        id="btn-order"
                        class="btn-checkout"
                    >
                        Đặt hàng ngay →
                    </x-button>

                </div>
            </div>{{-- end cột phải --}}

        </div>{{-- end grid --}}
    </form>

</div>{{-- end checkout-wrap --}}

<script>
const tongTienGoc = {{ $tongTien }};

// Scroll tới lỗi đầu tiên nếu có
document.addEventListener("DOMContentLoaded", function() {
    const firstError = document.querySelector(".form-error, .is-invalid");
    if (firstError) {
        firstError.closest(".form-group, .checkout-card")?.scrollIntoView({ behavior: "smooth", block: "center" });
    }
});
let voucherOpen   = false;

/* ── Phương thức thanh toán ── */
document.querySelectorAll('input[name="PTTT"]').forEach(radio => {
    radio.addEventListener('change', function () {
        document.querySelectorAll('.pttt-option').forEach(el => el.classList.remove('active'));
        this.closest('.pttt-option').classList.add('active');
        document.getElementById('ck-info').style.display = this.value === 'CK' ? 'block' : 'none';
    });
});

/* ── Cập nhật nội dung CK realtime ── */
function capNhatNoiDungCK() {
    const ten = document.querySelector('input[name="TenNguoiNhan"]')?.value.trim() || '';
    const sdt = document.querySelector('input[name="SoDienThoai"]')?.value.trim()  || '';
    const nd  = [ten, sdt].filter(Boolean).join(' - ') || '[Tên] + [SĐT]';
    const el  = document.getElementById('ck-noidung');
    if (el) el.textContent = nd;
}
document.querySelector('input[name="TenNguoiNhan"]')?.addEventListener('input', capNhatNoiDungCK);
document.querySelector('input[name="SoDienThoai"]')?.addEventListener('input', capNhatNoiDungCK);

/* ── Voucher dropdown ── */
function toggleVoucherDropdown() {
    voucherOpen = !voucherOpen;
    document.getElementById('voucher-dropdown').classList.toggle('open', voucherOpen);
    document.getElementById('voucher-selector').classList.toggle('open', voucherOpen);
    document.getElementById('voucher-chevron').classList.toggle('open', voucherOpen);
}

function selectVoucher(maVoucher, giamGia, tenVoucher) {
    voucherOpen = false;
    document.getElementById('voucher-dropdown').classList.remove('open');
    document.getElementById('voucher-selector').classList.remove('open');
    document.getElementById('voucher-chevron').classList.remove('open');

    const label = document.getElementById('voucher-label');
    const msg   = document.getElementById('voucher-msg');

    if (!maVoucher) {
        label.textContent = '-- Chọn voucher --';
        label.style.color = 'var(--gray-400)';
        document.getElementById('input-ma-voucher').value   = '';
        document.getElementById('input-gia-tri-giam').value = '0';
        document.getElementById('row-giam').style.display   = 'none';
        document.getElementById('txt-tong').textContent     = fmt(tongTienGoc);
        msg.textContent = '';
        msg.className   = 'voucher-msg';
        return;
    }

    label.textContent = maVoucher + (tenVoucher ? ' — ' + tenVoucher : '');
    label.style.color = 'var(--gold)';
    document.getElementById('input-ma-voucher').value   = maVoucher;
    document.getElementById('input-gia-tri-giam').value = giamGia;
    document.getElementById('row-giam').style.display   = 'flex';
    document.getElementById('txt-giam').textContent     = '-' + fmt(giamGia);
    document.getElementById('txt-tong').textContent     = fmt(tongTienGoc - giamGia);
    msg.textContent = '✅ Đã áp dụng voucher ' + maVoucher;
    msg.className   = 'voucher-msg ok';
}

function fmt(n) {
    return new Intl.NumberFormat('vi-VN').format(n) + 'đ';
}

/* ── Đóng dropdown khi click ngoài ── */
document.addEventListener('click', function (e) {
    const sel = document.getElementById('voucher-selector');
    const dd  = document.getElementById('voucher-dropdown');
    if (!sel || !dd) return;
    if (!sel.contains(e.target) && !dd.contains(e.target) && voucherOpen) {
        voucherOpen = false;
        dd.classList.remove('open');
        sel.classList.remove('open');
        document.getElementById('voucher-chevron').classList.remove('open');
    }
});

/* ── Chống submit double-click ── */
document.getElementById('form-order').addEventListener('submit', function () {
    const btn = document.getElementById('btn-order');
    if (btn) {
        btn.disabled    = true;
        btn.textContent = 'Đang xử lý...';
    }
});
</script>

@endsection