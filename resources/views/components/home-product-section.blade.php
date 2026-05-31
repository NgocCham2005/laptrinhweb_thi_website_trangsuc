@props([
    'title',
    'products',
    'type'
])

<div class="product-track {{ $type }}">

    <button class="hero-btn product-prev">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <div class="product-wrapper">

        @foreach ($products as $product)
            <div class="product-item">
                <x-product-card :product="$product" />
            </div>
        @endforeach

    </div>

    <button class="hero-btn product-next">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

</div>