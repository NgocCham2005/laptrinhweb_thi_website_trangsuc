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

            <div class="filter-options-group">
                
                <select name="gia" form="filterForm" onchange="document.getElementById('filterForm').submit()" class="filter-select">
                    <option value="">Giá (Tất cả)</option>
                    <option value="duoi-5tr" {{ ($priceFilter ?? '') === 'duoi-5tr' ? 'selected' : '' }}>Dưới 4.500.000đ</option>
                    <option value="5tr-10tr" {{ ($priceFilter ?? '') === '5tr-10tr' ? 'selected' : '' }}>4.500.000đ - 10.000.000đ</option>
                    <option value="tren-10tr" {{ ($priceFilter ?? '') === 'tren-10tr' ? 'selected' : '' }}>Trên 10.000.000đ</option>
                </select>

                <select name="chat_lieu" form="filterForm" onchange="document.getElementById('filterForm').submit()" class="filter-select">
                    <option value="all">Chất liệu (Tất cả)</option>
                    <option value="Bạc" {{ ($materialFilter ?? '') === 'Bạc' ? 'selected' : '' }}>Bạc</option>
                    <option value="Vàng" {{ ($materialFilter ?? '') === 'Vàng' ? 'selected' : '' }}>Vàng</option>
                </select>
                
            </div>

            <span class="products-count">Hiển thị {{ $products->total() }} sản phẩm</span>
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