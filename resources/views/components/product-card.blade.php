@props(['product'])

<div class="product-card">
    <div class="product-img-container">
        @if($product->hinhAnhSp && $product->hinhAnhSp->first())
            <img src="{{ asset('storage/' . $product->hinhAnhSp->first()->DuongDan) }}" alt="{{ $product->TenSanPham }}">
        @else
            <img src="{{ asset('images/default-jewelry.png') }}" alt="{{ $product->TenSanPham }}">
        @endif
    </div>

    <div class="product-content">
        <h3 class="product-title">{{ $product->TenSanPham }}</h3>
        
        <p class="product-material">Chất liệu: {{ $product->ChatLieu }}</p>
        
        <x-price-tag :gia="$product->GiaBan" />
        
        <div class="product-actions">
            <button type="button" class="btn-outline-navy">Thêm vào giỏ</button>
            <button type="button" class="btn-solid-gold">Mua ngay</button>
        </div>
    </div>
</div>