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

    <div class="quantity-row">
        <span class="info-label">Số lượng:</span>
        <div class="col-qty">
            <button type="button" class="qty-btn qty-decrease" aria-label="Giảm số lượng">−</button>
            <input id="productQuantity" class="qty-input" type="number" min="1" value="1" inputmode="numeric" pattern="[0-9]*">
            <button type="button" class="qty-btn qty-increase" aria-label="Tăng số lượng">+</button>
        </div>
    </div>

    <div class="product-actions">
    <form id="addToCartForm" action="{{ route('cart.them') }}" method="POST" style="flex:1">
        @csrf
        <input type="hidden" name="MaSanPham" value="{{ $product->MaSanPham }}">
        <input type="hidden" id="addToCartQuantity" name="SoLuong" value="1">
        <x-button type="submit" variant="secondary" :block="true">Thêm vào giỏ</x-button>
    </form>

    <form id="buyNowForm" action="{{ route('order.muaNgay') }}" method="POST" style="flex:1">
        @csrf
        <input type="hidden" name="MaSanPham" value="{{ $product->MaSanPham }}">
        <input type="hidden" id="buyNowQuantity" name="SoLuong" value="1">
        <x-button type="submit" :block="true">Mua ngay</x-button>
    </form>
</div>
</div>

<script>
    (function() {
        const quantityInput = document.getElementById('productQuantity');
        const hiddenQtys = [
            document.getElementById('addToCartQuantity'),
            document.getElementById('buyNowQuantity')
        ];

        const updateHiddenValues = value => {
            hiddenQtys.forEach(input => {
                if (input) input.value = value;
            });
        };

        const normalizeQuantity = value => {
            const qty = parseInt(value, 10);
            return Number.isNaN(qty) || qty < 1 ? 1 : qty;
        };

        const setQuantity = value => {
            const normalized = normalizeQuantity(value);
            quantityInput.value = normalized;
            updateHiddenValues(normalized);
        };

        Array.from(document.querySelectorAll('.qty-btn')).forEach(button => {
            button.addEventListener('click', function () {
                const current = normalizeQuantity(quantityInput.value);
                const next = this.classList.contains('qty-increase') ? current + 1 : current - 1;
                setQuantity(next);
            });
        });

        quantityInput.addEventListener('input', function () {
            setQuantity(this.value);
        });
    })();
</script>