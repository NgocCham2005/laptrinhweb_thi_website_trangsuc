@props(['gia', 'showLabel' => false])

<div class="price-wrapper">
    <span class="product-price">
        @if($showLabel) Giá: @endif{{ number_format($gia, 0, ',', '.') }}đ
    </span>
</div>