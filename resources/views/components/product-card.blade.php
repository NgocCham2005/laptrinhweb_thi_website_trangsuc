@props(['product'])

<div class="product-card">
    <a href="{{ route('products.detail', $product->MaSanPham) }}" style="text-decoration: none; display: block; width: 100%;">
        <div class="product-img-container">
            @if($product->images && $product->images->first())
                <img src="{{ asset('images/products/' . $product->images->first()->DuongDan) }}" alt="{{ $product->TenSanPham }}">
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
            <form action="{{ route('cart.them') }}" method="POST" style="flex:1">
                @csrf
                <input type="hidden" name="MaSanPham" value="{{ $product->MaSanPham }}">
                <input type="hidden" name="SoLuong" value="1">
                <x-button type="submit" variant="secondary" :block="true">Thêm vào giỏ</x-button>
            </form>

            <form action="{{ route('order.muaNgay') }}" method="POST" style="flex:1">
                @csrf
                <input type="hidden" name="MaSanPham" value="{{ $product->MaSanPham }}">
                <input type="hidden" name="SoLuong" value="1">
                <x-button type="submit" :block="true">Mua ngay</x-button>
            </form>
        </div>
    </div>
</div>