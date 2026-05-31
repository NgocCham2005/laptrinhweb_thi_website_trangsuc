@extends('layouts.app')

@section('content')

<x-banner />

<x-hero />
<x-section-title title="Sản phẩm nổi bật" />
<x-home-product-section
    :products="$featuredProducts"
    type="featured"
/>
<x-section-title title="Sản phẩm mới" />
<x-home-product-section
    :products="$newProducts"
    type="new"
/>
<x-section-title title="Sản phẩm bán chạy" />
<x-home-product-section
    :products="$bestSellingProducts"
    type="best_selling"
/>
@endsection