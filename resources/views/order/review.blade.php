@extends('layouts.app')

@section('content')

<div class="review-container">

    <h2 class="review-title">Đánh giá sản phẩm</h2>

    <!-- {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Lỗi validate --}}
    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    <div class="review-product">
        <h3 class="product-name">{{ $sanPham->TenSanPham }}</h3>
        <p class="product-code">Mã sản phẩm: {{ $sanPham->MaSanPham }}</p>
        <div style="display:flex; justify-content:center; align-items:center; height:400px;">
            <img src="{{ asset('images/products/'.$sanPham->MaSanPham.'_1.png') }}" width=300px alt="{{ $sanPham->TenSanPham }}">
        </div>  
    </div>

    <form action="{{ route('review.store') }}" method="POST" class="review-form">
        @csrf

        <!-- <input type="hidden" name="product_id" value="{{ $sanPham->MaSanPham }}">
        <input type="hidden" name="order_id" value="{{ $order }}"> -->
        
        <!-- sửa components sau -->
        <div class="form-group">
            <label>Đánh giá của bạn</label>
            <br><br>
            <select name="rating">
                <option value="5">
                    ★★★★★ - Rất hài lòng
                </option>
                <option value="4">
                    ★★★★ - Hài lòng
                </option>
                <option value="3">
                    ★★★ - Bình thường
                </option>
                <option value="2">
                    ★★ - Chưa hài lòng
                </option>
                <option value="1">
                    ★ - Không hài lòng
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Nhận xét</label>
            <br><br>
            <textarea name="comment" rows="6" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm..."></textarea>
        </div>

        <x-button type="submit" variant="primary"> Gửi đánh giá </x-button>
    </form>
</div>

@endsection