@extends('layouts.admin')

@section('page-title','Quản lý voucher')

@section('content')

<div class="page-header">
    <h3>Sửa voucher</h3>
</div>

<form
action="
{{
route(
'admin.vouchers.update',
$voucher->MaVoucher
)
}}
"

method="POST"
>

@csrf

@method('PUT')


<x-input
name="TenVoucher"
label="Tên"

:value="$voucher->TenVoucher"
/>


<x-input
name="DieuKien"
label="Điều kiện"

:value="$voucher->DieuKien"
/>


<x-input
name="GiaTriGiamToiDa"
label="Giảm tối đa"

:value="$voucher->GiaTriGiamToiDa"
/>


<x-input
name="SoLanSuDung"
label="Số lần"

:value="$voucher->SoLanSuDung"
/>


<x-input
name="TrangThai"
label="Trạng thái"

:value="$voucher->TrangThai"
/>


<x-button type="submit">
Lưu
</x-button>

</form>

@endsection