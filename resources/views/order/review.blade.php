@extends('layouts.app')

@section('content')

<div class="review-container">

    <h2 class="review-title">Đánh giá sản phẩm</h2>

    <div class="review-product">
        <h3 class="product-name">{{ $sanPham->TenSanPham }}</h3>
        <p class="product-code">Mã sản phẩm: {{ $sanPham->MaSanPham }}</p>
        <div style="display:flex; justify-content:center; align-items:center; height:300px;">
            <img src="{{ asset('images/products/'.$sanPham->MaSanPham.'_1.png') }}" width=300px alt="{{ $sanPham->TenSanPham }}">
        </div>  
    </div>
    
    @if($review)
        <form action="{{ route('review.update',$review->MaDanhGia) }}" method="POST" class="review-form">
            @csrf
            @method('PUT')

    @else
        <form action="{{ route('review.store') }}" method="POST" class="review-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $sanPham->MaSanPham }}">
            <input type="hidden" name="order_id" value="{{ $order }}">
    @endif
    
            <div class="form-group">
                <x-input type="select" name="rating" label="Số sao">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ isset($review) && $review->XepHang == $i ? 'selected' : ''}}>
                            {{ $i }} ⭐
                        </option>
                    @endfor
                </x-input>
            </div>

            <div class="form-group">
                <x-input type="textarea" name="comment" label="Bình luận" rows="5" value="{{ $review->BinhLuan ?? '' }}"></x-input>
            </div>

            <div class="review-actions">
                @if($review)
                    <x-button type="button" variant="outline-navy" onclick="history.back()">Quay lại</x-button>
                    <x-button type="submit" variant="secondary">
                        Sửa đánh giá
                    </x-button>
        </form>
                    
                @else
                    <x-button type="button" variant="outline-navy" onclick="history.back()">Quay lại</x-button>
                    <x-button type="submit" variant="primary">Gửi đánh giá</x-button>
        </form>
                @endif
            </div>
</div>

@endsection