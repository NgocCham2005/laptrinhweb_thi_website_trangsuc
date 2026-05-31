@props(['product'])

<div class="product-info-box">
    <h2 class="info-title">{{ $product->TenSanPham }}</h2>
    
    <hr class="info-divider">

    <div class="info-body">
        <div class="info-row">
            <span class="info-label">Giá:</span>
            <span class="info-price-red">{{ number_format($product->GiaBan, 0, ',', '.') }}đ</span>
        </div>
        <div class="info-row">
            <span class="info-label">Chất liệu:</span>
            <span class="info-value">{{ $product->ChatLieu }}</span>
        </div>
        <div class="info-row align-start">
            <span class="info-label">Mô tả:</span>
            <p class="info-value info-desc">{{ $product->MoTa ?? 'Chưa có mô tả cho sản phẩm này.' }}</p>
        </div>
    </div>

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