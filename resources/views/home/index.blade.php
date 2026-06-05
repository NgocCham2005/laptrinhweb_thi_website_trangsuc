@extends('layouts.app')

@section('content')

<x-banner />
<div class="product-block">
<x-section-title title="Danh mục sản phẩm" />  
<x-hero :categories="$categories" />
</div>
<div class="product-block">
    <x-section-title title="Sản phẩm nổi bật" />
    <x-home-product-section
        :products="$featuredProducts"
        type="featured"
    />
</div>
<div class="product-block">
    <x-section-title title="Sản phẩm mới" />
    <x-home-product-section
        :products="$newProducts"
        type="new"
    />
</div>
<div class="product-block">
    <x-section-title title="Sản phẩm bán chạy" />
    <x-home-product-section
        :products="$bestSellingProducts"
        type="best_selling"
    />
</div>
@endsection