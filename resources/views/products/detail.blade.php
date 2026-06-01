@extends('layouts.app')

@section('content')

<section class="product-detail">

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">Sản phẩm</a>
        <span>/</span>
        <a href="{{ route('products.index', ['category' => $product->MaDanhMuc]) }}">
            {{ $product->category->TenDanhMuc }}</a>
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
        <div class="product-info-wrapper">
            <x-product-info :product="$product" />
            <div class="banner-con">
                <img src="{{ asset('images/banner-con.jpg') }}">
            </div>
        </div>
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

    <div class="section-title">
        <h2>ĐÁNH GIÁ SẢN PHẨM</h2>
    </div>
    <div class="review-box">
        @if($product->reviews->count() >0)
            @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="review-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="review-content">
                    <h4>
                        {{ $review->MaTaiKhoan }}
                    </h4>
                    <!-- STAR -->
                    <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->XepHang)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <p>
                        {{ $review->BinhLuan }}
                    </p>
                    <!-- REPLY -->
                    @foreach($review->replies as $reply)
                        <div class="admin-reply">
                            <strong>Shop phản hồi:</strong>
                            <p>
                                {{ $reply->NoiDungPhanHoi }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        <div class="review-line"></div>
        @endforeach
        @else
            <div class="empty-review">
                <i class="fa-regular fa-comment-dots"></i>
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            </div>
        </div>
        @endif
    </div>

    <!-- <form action="{{ route('review.store') }}" method="POST" class="review-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->MaSanPham }}">
        <select name="rating">
            <option value="5">5 sao</option>
            <option value="4">4 sao</option>
            <option value="3">3 sao</option>
            <option value="2">2 sao</option>
            <option value="1">1 sao</option>
        </select>

        <input type="text" name="comment" placeholder="Viết đánh giá...">
            <button type="submit">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
    </form> -->

    <!-- Sản phẩm tương tự -->
    <div class="related-products">
        <div class="related-header">
            <h2>SẢN PHẨM TƯƠNG TỰ</h2>
            <a href="{{ route('products.index', ['category' => $product->MaDanhMuc]) }}">
                Xem thêm    
                <i class="fa-solid fa-arrow-right"></i>
            </a>
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