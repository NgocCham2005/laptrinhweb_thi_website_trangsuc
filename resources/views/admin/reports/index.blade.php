@extends('layouts.admin')

@section('title','Báo cáo')

@section('page-title', 'Báo cáo thống kê')

@section('content')

<link rel="stylesheet" href="{{ asset('css/report.css') }}">

<div class="report-wrapper">

    <div class="report-tabs">

        <button
            class="tab-btn active"
            onclick="showTab(event,'revenue')">
            Báo cáo doanh thu
        </button>

        <button
            class="tab-btn"
            onclick="showTab(event,'orders')">
            Báo cáo đơn hàng
        </button>

    </div>

    @include('admin.reports.revenue')

    @include('admin.reports.orders')

</div>

@include('admin.reports.scripts')

@endsection