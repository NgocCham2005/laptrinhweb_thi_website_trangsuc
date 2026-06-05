@extends('layouts.admin')

@section('title','Voucher')

@section('page-title', 'Quản lý Voucher')

@section('content')

<link rel="stylesheet" href="{{ asset('css/voucher.css') }}">

{{-- SEARCH + FILTER --}}

<div class="filter-bar">

    <form method="GET" class="filter-form">

        <input
            type="text"
            name="keyword"
            class="form-control search-box"
            placeholder="Tìm mã hoặc tên voucher"
            value="{{ request('keyword') }}"
        >

        <select name="status" class="form-control status-filter">
            <option value="">Tất cả trạng thái</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Đã vô hiệu</option>
        </select>

        <x-button type="submit">Lọc</x-button>

    </form>

</div>

{{-- HEADER --}}
<div class="page-header">

    <h3>Danh sách voucher</h3>

    <a href="{{ route('admin.vouchers.create') }}">
        <x-button>Thêm voucher</x-button>
    </a>

</div>

{{-- TABLE --}}
<x-table
    :headers="['Mã','Tên','Điều kiện','Giảm tối đa','Số lần','Trạng thái','Thao tác']"
    striped
>

    @foreach($vouchers as $v)

        <tr>

            <td>{{ $v->MaVoucher }}</td>
            <td>{{ $v->TenVoucher }}</td>
            <td>{{ $v->DieuKien }}</td>
            <td>{{ $v->GiaTriGiamToiDa }}</td>
            <td>{{ $v->SoLanSuDung }}</td>

            <td>
                @if($v->TrangThai == 1)
                    <x-badge variant="success">Hoạt động</x-badge>
                @else
                    <x-badge variant="danger">Đã vô hiệu</x-badge>
                @endif
            </td>

            {{-- CỘT THAO TÁC --}}
            <td class="action-col">

                <div class="action-buttons">

                    <a href="{{ route('admin.vouchers.edit',$v->MaVoucher) }}">
                        <x-button>Sửa</x-button>
                    </a>

                    @if($v->TrangThai == 1)

                        <x-button
                            variant="danger"
                            type="button"
                            onclick="openModal('disableVoucher{{ $v->MaVoucher }}')"
                        >
                            Vô hiệu
                        </x-button>

                    @else

                        <x-button
                            variant="secondary"
                            type="button"
                            onclick="openModal('restoreVoucher{{ $v->MaVoucher }}')"
                        >
                            Mở khóa
                        </x-button>

                    @endif

                </div>

            </td>

        </tr>

        <x-modal id="disableVoucher{{ $v->MaVoucher }}" title="Vô hiệu hóa voucher">

            Bạn có chắc chắn muốn vô hiệu hóa voucher <b>{{ $v->TenVoucher }}</b> ?

            <x-slot:footer>

                <form
                    action="{{ route('admin.vouchers.destroy', $v->MaVoucher) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <x-button variant="danger" type="submit">
                        Xác nhận
                    </x-button>

                </form>

                <x-button
                    variant="ghost"
                    type="button"
                    onclick="closeModal('disableVoucher{{ $v->MaVoucher }}')"
                >
                    Hủy
                </x-button>

            </x-slot:footer>

        </x-modal>
    
        <x-modal id="restoreVoucher{{ $v->MaVoucher }}" title="Mở khóa voucher">

            Bạn có chắc chắn muốn mở khóa voucher <b>{{ $v->TenVoucher }}</b> ?

            <x-slot:footer>

                <form
                    action="{{ route('admin.vouchers.restore', $v->MaVoucher) }}"
                    method="POST"
                    style="display:inline"
                >
                    @csrf
                    @method('POST')

                    <x-button variant="danger" type="submit">
                        Xác nhận
                    </x-button>

                </form>

                <x-button
                    variant="ghost"
                    type="button"
                    onclick="closeModal('restoreVoucher{{ $v->MaVoucher }}')"
                >
                    Hủy
                </x-button>

            </x-slot:footer>

        </x-modal>

    @endforeach

</x-table>

<x-pagination :paginator="$vouchers" />

@endsection