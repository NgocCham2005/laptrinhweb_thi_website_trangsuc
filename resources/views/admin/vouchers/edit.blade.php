@extends('layouts.admin')

@section('page-title', 'Quản lý voucher')

@section('title','Sửa voucher')

@section('content')

<div class="page-header">
    <h3>Sửa voucher</h3>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Vui lòng kiểm tra lại thông tin đã nhập!
    </div>
@endif

{{-- FORM SỬA VOUCHER --}}
<form action="{{ route('admin.vouchers.update', $voucher->MaVoucher) }}" method="POST">

    @csrf
    @method('PUT')

    <x-input name="MaVoucher" label="Mã voucher" :value="$voucher->MaVoucher" disabled />
    <x-input name="TenVoucher" label="Tên voucher" :value="$voucher->TenVoucher" />
    <x-input name="DieuKien" label="Điều kiện" :value="$voucher->DieuKien" />
    <x-input name="GiaTriGiamToiDa" label="Giá trị giảm tối đa" :value="$voucher->GiaTriGiamToiDa" />
    <x-input
        name="NgayHetHan"
        label="Ngày hết hạn"
        type="date"
        :value="$voucher->NgayHetHan"
        min="{{ date('Y-m-d') }}"
        required
    />

    <x-input
        name="SoLuong"
        label="Số lượng"
        :value="$voucher->SoLuong"
    />

    <x-input type="select" name="TrangThai" label="Trạng thái" required>
        <option value="">-- Chọn trạng thái --</option>
        <option value="1"
            {{ old('TrangThai', $voucher->TrangThai) == '1' ? 'selected' : '' }}>
            Hoạt động
        </option>
        <option value="0"
            {{ old('TrangThai', $voucher->TrangThai) == '0' ? 'selected' : '' }}>
            Vô hiệu hóa
        </option>
    </x-input>

    <div class="action-buttons">

        <x-button type="submit">Cập nhật</x-button>

        <a href="{{ route('admin.vouchers') }}" style="text-decoration:none;">
            <x-button variant="outline-navy">Quay lại</x-button>
        </a>

    </div>

</form>

@endsection