@extends('layouts.app')

@section('content')

<section class="product-detail">

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>/</span>
        <a href="">Sản phẩm</a>
        <span>/</span>
        <p>{{ $product->TenSanPham }}</p>
    </div>

    <!-- Thông tin chung -->
    <div class="product-top">
        <div class="product-gallery">
            <div class="main-image">
                <img id="mainProductImage" src="{{ asset('images/products/' .$product->images[0]->DuongDan) }}">
            </div>
            <div class="thumbnail-list">
                @foreach($product->images as $index => $image)
                    <div class="thumbnail
                        {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('images/products/' .$image->DuongDan) }}">
                    </div>
                @endforeach
            </div>
        </div>
        <x-product-info :product="$product" />
    </div>

    <!-- Mô tả sản phẩm -->
    <div class="product-description">
        <div class="section-title">
            <h2>MÔ TẢ SẢN PHẨM</h2>
        </div>
        <div class="description-content">
            <p>{{ $product->MoTa }}</p>
        </div>
    </div>

    <!-- Sản phẩm tương tự -->
    <div class="related-products">
        <div class="related-header">
            <h2>SẢN PHẨM TƯƠNG TỰ</h2>
        </div>
        <div class="related-grid">
            @foreach($relatedProducts as $item)
                <x-product-card :product="$item" />
            @endforeach
        </div>
    </div>

    <script>
        const thumbnails =document.querySelectorAll('.thumbnail img');
        const mainImage =document.getElementById('mainProductImage');
        thumbnails.forEach(item => {
            item.addEventListener('click', function(){
                mainImage.src = this.src;
            });
        });
    </script>

</section>

@endsection