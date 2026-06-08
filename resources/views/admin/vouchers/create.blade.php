@extends('layouts.admin')

@section('page-title', 'Quản lý Voucher')

@section('title','Thêm voucher')

@section('content')

<div class="page-header">
    <h3>Thêm voucher</h3>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Vui lòng kiểm tra lại thông tin đã nhập!
    </div>
@endif

{{-- FORM THÊM VOUCHER --}}
<form method="POST" action="{{ route('admin.vouchers.store') }}">
    @csrf

    <div class="form-grid">

        <x-input name="MaVoucher" label="Mã voucher" :value="$newCode" disabled />
        <x-input name="TenVoucher" label="Tên voucher" required />
        <x-input name="DieuKien" label="Điều kiện" />
        <x-input name="GiaTriGiamToiDa" label="Giá trị giảm tối đa" type="number" />
        <x-input
            name="NgayHetHan"
            label="Ngày hết hạn"
            type="date"
            min="{{ date('Y-m-d') }}"
            required
        />

        <x-input
            name="SoLuong"
            label="Số lượng"
            type="number"
        />
        <x-input type="select" name="TrangThai" label="Trạng thái" required>
            <option value="">-- Chọn trạng thái --</option>
            <option value="1" {{ old('TrangThai') == '1' ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ old('TrangThai') == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
        </x-input>

    </div>

    <div class="action-buttons">

        <x-button type="submit">
            Thêm voucher
        </x-button>

        <a href="{{ route('admin.vouchers') }}" style="text-decoration: none;">
            <x-button variant="outline-navy">
                Quay lại
            </x-button>
        </a>

    </div>

</form>

@endsection