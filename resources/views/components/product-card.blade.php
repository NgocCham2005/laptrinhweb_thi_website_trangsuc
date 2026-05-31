@props(['product'])

<div class="product-card">
    <a href="{{ route('products.detail', $product->MaSanPham) }}" style="text-decoration: none; display: block; width: 100%;">
        <div class="product-img-container">
            @if($product->hinhAnhSp && $product->hinhAnhSp->first())
                <img src="{{ asset('storage/' . $product->hinhAnhSp->first()->DuongDan) }}" alt="{{ $product->TenSanPham }}">
            @else
                <img src="{{ asset('images/default-jewelry.png') }}" alt="{{ $product->TenSanPham }}">
            @endif
        </div>
    </a>

    <div class="product-content">
        <a href="{{ route('products.detail', $product->MaSanPham) }}" style="text-decoration: none; color: inherit; display: block;">
            <h3 class="product-title">{{ $product->TenSanPham }}</h3>
        </a>
        
        <p class="product-material">Chất liệu: {{ $product->ChatLieu }}</p>
        
        <x-price-tag :gia="$product->GiaBan" />
        
        <div class="product-actions">
            <x-button variant="secondary">Thêm vào giỏ</x-button>
            <x-button>Mua ngay</x-button>
        </div>
    </div>
</div>