@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="cart-container">

    {{-- ══ TIÊU ĐỀ ══ --}}
    <div class="cart-header">
        <h1 class="cart-title">Giỏ hàng của tôi</h1>
        @if(count($chiTiet) > 0)
            <span class="cart-count">{{ count($chiTiet) }} sản phẩm</span>
        @endif
    </div>

    {{-- ══ THÔNG BÁO ══ --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- ══ GIỎ HÀNG TRỐNG ══ --}}
    @if(count($chiTiet) === 0)
        <div class="cart-empty">
            <div class="cart-empty-icon">🛒</div>
            <h3>Giỏ hàng trống</h3>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <a href="{{ url('/san-pham') }}">
                <x-button variant="primary">Tiếp tục mua sắm</x-button>
            </a>
        </div>

    {{-- ══ CÓ SẢN PHẨM ══ --}}
    @else
        <div class="cart-layout">

            {{-- CỘT TRÁI: Bảng sản phẩm --}}
            <div class="cart-items">
                <x-table :headers="['', 'Mã SP', 'Tên sản phẩm', 'Đơn giá', 'Số lượng', 'Thành tiền', 'Thao tác']">

                    @foreach($chiTiet as $item)
                    <tr class="cart-row" id="row-{{ $item->MaSanPham }}">

                        {{-- Checkbox chọn --}}
                        <td class="td-check">
                            <label class="custom-check">
                                <input type="checkbox"
                                    class="sp-checkbox"
                                    data-ma="{{ $item->MaSanPham }}"
                                    onchange="onCheckChange()">
                                <span class="checkmark"></span>
                            </label>
                        </td>

                        {{-- Mã SP --}}
                        <td><span class="item-code">{{ $item->MaSanPham }}</span></td>

                        {{-- Tên --}}
                        <td><span class="item-name">{{ $item->sanPham->TenSanPham }}</span></td>

                       {{-- Đơn giá --}}
<td>
    <span class="item-price-plain">
        {{ number_format($item->sanPham->GiaBan, 0, ',', '.') }}đ
    </span>
</td>

                        {{-- Số lượng: + / - auto-save --}}
                        <td>
                            <div class="col-qty">
                                <button type="button" class="qty-btn"
                                    onclick="thayDoiSoLuong(this, -1)">−</button>
                                <input type="number"
                                    class="qty-input"
                                    value="{{ $item->SoLuong }}"
                                    min="1"
                                    max="{{ $item->sanPham->SoLuongTon }}"
                                    data-ma="{{ $item->MaSanPham }}"
                                    data-gia="{{ $item->sanPham->GiaBan }}"
                                    data-max="{{ $item->sanPham->SoLuongTon }}"
                                    onchange="luuSoLuong(this)">
                                <button type="button" class="qty-btn"
                                    onclick="thayDoiSoLuong(this, 1)">+</button>
                                <span class="qty-saving" style="display:none;">⏳</span>
                            </div>
                        </td>

                        {{-- Thành tiền --}}
                        <td>
                            <span class="item-total" data-don-gia="{{ $item->sanPham->GiaBan }}">
                                {{ number_format($item->SoLuong * $item->sanPham->GiaBan, 0, ',', '.') }}đ
                            </span>
                        </td>

                        {{-- Xóa --}}
                        <td>
                            <x-button
                                size="sm"
                                variant="danger"
                                class="btn-xoa-sp btn-xoa-hidden"
                                data-ma="{{ $item->MaSanPham }}"
                                data-ten="{{ $item->sanPham->TenSanPham }}"
                                onclick="openModal('modal-xoa-{{ $item->MaSanPham }}')">
                                Xóa
                            </x-button>

                            <x-modal id="modal-xoa-{{ $item->MaSanPham }}" title="Xác nhận xóa">
                                <p>Bạn có chắc muốn xóa
                                    <strong>{{ $item->sanPham->TenSanPham }}</strong>
                                    khỏi giỏ hàng?
                                </p>
                                <x-slot name="footer">
                                    <x-button variant="ghost"
                                        onclick="closeModal('modal-xoa-{{ $item->MaSanPham }}')">
                                        Hủy
                                    </x-button>
                                    <form action="{{ route('cart.xoa') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="MaSanPham" value="{{ $item->MaSanPham }}">
                                        <x-button type="submit" variant="danger">Xóa</x-button>
                                    </form>
                                </x-slot>
                            </x-modal>
                        </td>

                    </tr>
                    @endforeach

                </x-table>

                {{-- Thanh action bên dưới bảng --}}
                <div class="cart-actions">
                    <label class="check-all-label">
                        <input type="checkbox" id="check-all" onchange="checkAll(this)">
                        <span>Chọn tất cả</span>
                    </label>
                    <div class="cart-actions-right">
                        <span class="selected-info" id="selected-info"></span>
                        <x-button variant="danger" size="sm" id="btn-xoa-nhieu"
                            disabled onclick="openModal('modal-xoa-nhieu')">
                            Xóa đã chọn
                        </x-button>
                    </div>
                </div>
            </div>

            {{-- CỘT PHẢI: Tóm tắt --}}
            <div class="cart-summary">
                <div class="summary-card">
                    <h3 class="summary-title">Tóm tắt đơn hàng</h3>

                    <div id="summary-details" style="display:none;">
                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span id="tong-tam-tinh"></span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row summary-total">
                        <span>Tổng cộng</span>
                        <span id="tong-cuoi" class="total-price"></span>
                    </div>
                    </div>

                    <p class="checkout-hint" id="checkout-hint"> Hãy chọn sản phẩm muốn mua</p>

                    {{-- Nút đặt hàng --}}
                    <x-button variant="primary" :block="true" size="lg"
                        id="btn-checkout" disabled
                        onclick="diDenCheckout()">
                        Đặt hàng ngay →
                    </x-button>

                    <a href="{{ url('/san-pham') }}" class="cart-back-link">
                        <x-button variant="outline-navy" :block="true" style="margin-top:10px;">
                            ← Tiếp tục mua sắm
                        </x-button>
                    </a>
                </div>
            </div>

        </div>

        {{-- Modal xóa nhiều --}}
        <x-modal id="modal-xoa-nhieu" title="Xác nhận xóa">
            <p id="modal-xoa-nhieu-text">Bạn có chắc muốn xóa các sản phẩm đã chọn?</p>
            <x-slot name="footer">
                <x-button variant="ghost" onclick="closeModal('modal-xoa-nhieu')">Hủy</x-button>
                <x-button variant="danger" onclick="xoaNhieu()">Xóa</x-button>
            </x-slot>
        </x-modal>

    @endif
</div>

<script>
const CSRF      = '{{ csrf_token() }}';
const URL_SUA   = '{{ route("cart.sua") }}';
const URL_XOA   = '{{ route("cart.xoa") }}';

// ── Checkbox logic ──
function onCheckChange() {
    const checkboxes = document.querySelectorAll('.sp-checkbox');
    const checked    = document.querySelectorAll('.sp-checkbox:checked');
    const soChon     = checked.length;

    // Cập nhật "chọn tất cả"
    const checkAll = document.getElementById('check-all');
    checkAll.indeterminate = soChon > 0 && soChon < checkboxes.length;
    checkAll.checked = soChon === checkboxes.length;

    // Hiện/ẩn nút Xóa từng dòng bằng class, không dùng disabled
    checkboxes.forEach(cb => {
        const row    = cb.closest("tr");
        const btnXoa = row.querySelector(".btn-xoa-sp");
        if (btnXoa) {
            if (cb.checked) {
                btnXoa.classList.remove("btn-xoa-hidden");
            } else {
                btnXoa.classList.add("btn-xoa-hidden");
            }
        }
    });

    // Bật/tắt nút Xóa đã chọn
    const btnXoaNhieu = document.getElementById("btn-xoa-nhieu");
    btnXoaNhieu.disabled = soChon === 0;

    // Bật/tắt nút Đặt hàng
    const btnCheckout = document.getElementById("btn-checkout");
    btnCheckout.disabled = soChon === 0;

    // Hint text
    const hint = document.getElementById("checkout-hint");
    hint.style.display = soChon === 0 ? "block" : "none";

    // Hiện/ẩn tóm tắt đơn hàng
    const summaryDetails = document.getElementById("summary-details");
    summaryDetails.style.display = soChon === 0 ? "none" : "block";

    // Info số đã chọn
    const info = document.getElementById("selected-info");
    info.textContent = soChon > 0 ? `Đã chọn ${soChon} sản phẩm` : "";

    // Tính lại tổng
    tinhLaiTong();
}

function checkAll(cb) {
    document.querySelectorAll('.sp-checkbox').forEach(function(el) {
        el.checked = cb.checked;
    });
    onCheckChange();
}

// ── Tổng tiền chỉ tính sản phẩm đã chọn ──
function tinhLaiTong() {
    let tong = 0;
    document.querySelectorAll('.sp-checkbox:checked').forEach(function(cb) {
        const row = cb.closest('tr');
        const gia = parseFloat(row.querySelector('.qty-input').dataset.gia);
        const sl  = parseInt(row.querySelector('.qty-input').value) || 1;
        tong += gia * sl;
    });

    // Nếu không chọn gì → hiện tổng toàn bộ
    const soChon = document.querySelectorAll('.sp-checkbox:checked').length;
    if (soChon === 0) {
        let tongTatCa = 0;
        document.querySelectorAll('.qty-input').forEach(function(inp) {
            tongTatCa += parseFloat(inp.dataset.gia) * (parseInt(inp.value) || 1);
        });
        tong = tongTatCa;
    }

    document.getElementById('tong-tam-tinh').textContent = formatVnd(tong);
    document.getElementById('tong-cuoi').textContent     = formatVnd(tong);
}

// ── Nút + / - ──
function thayDoiSoLuong(btn, delta) {
    const wrap  = btn.closest('.col-qty');
    const input = wrap.querySelector('.qty-input');
    const min   = parseInt(input.min) || 1;
    const max   = parseInt(input.max);
    let val     = parseInt(input.value) + delta;
    if (val < min) val = min;
    if (val > max) val = max;
    if (val === parseInt(input.value)) return;
    input.value = val;

    // Cập nhật thành tiền dòng đó
    const row = input.closest('tr');
    row.querySelector('.item-total').textContent =
        formatVnd(parseFloat(input.dataset.gia) * val);

    tinhLaiTong();
    luuSoLuong(input);
}

// ── AJAX lưu số lượng ──
function luuSoLuong(input) {
    const wrap   = input.closest('.col-qty');
    const saving = wrap.querySelector('.qty-saving');
    if (saving) saving.style.display = 'inline';
    input.disabled = true;

    fetch(URL_SUA, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ MaSanPham: input.dataset.ma, SoLuong: parseInt(input.value) })
    })
    .then(r => r.json())
    .then(data => { if (!data.success) showToast(data.message || 'Lỗi!', 'danger'); })
    .catch(() => showToast('Lỗi kết nối!', 'danger'))
    .finally(() => {
        if (saving) saving.style.display = 'none';
        input.disabled = false;
    });
}

// ── Xóa nhiều ──
function xoaNhieu() {
    const checked = document.querySelectorAll('.sp-checkbox:checked');
    const promises = Array.from(checked).map(cb => {
        return fetch(URL_XOA, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ MaSanPham: cb.dataset.ma })
        });
    });

    Promise.all(promises).then(() => {
        window.location.reload();
    });
}

// ── Đặt hàng chỉ SP đã chọn ──
function diDenCheckout() {
    const checked = document.querySelectorAll('.sp-checkbox:checked');
    if (checked.length === 0) return;

    // Tạo form POST gửi danh sách SP đã chọn
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("order.checkout") }}';

    // CSRF
    const csrf = document.createElement('input');
    csrf.type  = 'hidden';
    csrf.name  = '_token';
    csrf.value = CSRF;
    form.appendChild(csrf);

    // Danh sách SP đã chọn
    checked.forEach(cb => {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'sp_chon[]';
        input.value = cb.dataset.ma;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function showToast(msg, type) {
    const t = document.createElement('div');
    t.className = 'alert alert-' + (type || 'success');
    t.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;min-width:260px;box-shadow:0 4px 16px rgba(0,0,0,.12);';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 3000);
}

function formatVnd(n) {
    return Math.round(n).toLocaleString('vi-VN') + 'đ';
}
</script>

@endsection