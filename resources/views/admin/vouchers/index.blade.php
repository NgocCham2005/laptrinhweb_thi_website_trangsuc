@extends('layouts.admin')

@section('page-title', 'Quản lý Voucher')

@section('content')

{{-- HEADER --}}
<div class="page-header">
    <h3>Danh sách voucher</h3>

    <a href="{{ route('admin.vouchers.create') }}">
        <x-button>
            + Thêm voucher
        </x-button>
    </a>
</div>

{{-- TABLE --}}
<x-table
    :headers="['Mã','Tên','Điều kiện','Giảm tối đa','Số lần','Trạng thái', 'Thao tác']"
    striped
>

    @foreach($vouchers as $v)
        <tr>
            <td>{{ $v->MaVoucher }}</td>
            <td>{{ $v->TenVoucher }}</td>
            <td>{{ $v->DieuKien }}</td>
            <td>{{ $v->GiaTriGiamToiDa }}</td>
            <td>{{ $v->SoLanSuDung }}</td>
            <td>{{ $v->TrangThai }}</td>

            {{-- CỘT THAO TÁC --}}
            <td class="action-col">
                <div class="action-buttons">
                    <a href="#">
                        <x-button>Sửa</x-button>
                    </a>
                    <a href="#">
                        <x-button variant="danger">Xóa</x-button>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach

</x-table>

@endsection