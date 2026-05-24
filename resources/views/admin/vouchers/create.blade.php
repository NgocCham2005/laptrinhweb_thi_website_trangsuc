@extends('layouts.admin')

@section('page-title', 'Quản lý Voucher')

@section('content')

<div class="page-header">
    <h3>Thêm voucher</h3>
</div>

{{-- FORM THÊM VOUCHER --}}
<form method="POST" action="{{ route('admin.vouchers.store') }}">
    @csrf

    <div class="form-grid">

        <x-input name="MaVoucher" label="Mã voucher" required />
        <x-input name="TenVoucher" label="Tên voucher" required />
        <x-input name="DieuKien" label="Điều kiện" />
        <x-input name="GiaTriGiamToiDa" label="Giảm tối đa" type="number" />
        <x-input name="SoLanSuDung" label="Số lần sử dụng" type="number" />
        <x-input name="TrangThai" label="Trạng thái" />

    </div>

    <div style="margin-top: 15px;">
        <x-button type="submit" variant="primary">
            Thêm voucher
        </x-button>
    </div>
</form>

@endsection