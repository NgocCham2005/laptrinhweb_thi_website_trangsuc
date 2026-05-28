@extends('layouts.app')

@section('content')
<div class="products-container">
    
    <aside class="category-sidebar">
        <h3 class="sidebar-title">Danh mục sản phẩm</h3>
        <div class="category-list">
            
            <a href="{{ route('products.index', ['danh_muc' => 'all']) }}" 
               class="category-item {{ (empty($selectedCategory) || $selectedCategory == 'all') ? 'active' : '' }}">
                Tất cả danh mục
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['danh_muc' => $cat->MaDanhMuc]) }}" 
                   class="category-item {{ $selectedCategory == $cat->MaDanhMuc ? 'active' : '' }}">
                    {{ $cat->TenDanhMuc }}
                </a>
            @endforeach

        </div>
    </aside>

    <main class="products-main">
        
        <div class="products-filter-header">
            <span class="filter-title">Bộ lọc</span>
            <span class="products-count">Hiển thị {{ $products->count() }} sản phẩm</span>
        </div>

        <div class="products-grid">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="no-product-message">
                    <p>Hiện tại chưa có sản phẩm nào thuộc danh mục này.</p>
                </div>
            @endforelse
        </div>

          <x-pagination :paginator="$products"/>

    </main>

</div>
@endsection