@extends('layouts.app')

@section('content')
<div class="products-container">
    
    <aside class="category-sidebar">
        <h3 class="sidebar-title">Danh mục sản phẩm</h3>
        <div class="category-list">
            
            <a href="javascript:void(0)" 
               data-id="all"
               class="category-link category-item {{ (empty($selectedCategory) || $selectedCategory == 'all') ? 'active' : '' }}">
                Tất cả danh mục
            </a>

            @foreach($categories as $cat)
                <a href="javascript:void(0)" 
                   data-id="{{ $cat->MaDanhMuc }}"
                   class="category-link category-item {{ $selectedCategory == $cat->MaDanhMuc ? 'active' : '' }}">
                    {{ $cat->TenDanhMuc }}
                </a>
            @endforeach

        </div>
    </aside>

    <main class="products-main">
        
        <div class="products-filter-header">
            <span class="filter-title">Bộ lọc</span>

            <form id="filterForm" action="{{ route('products.index') }}" method="GET">
                
                <input type="hidden" name="danh_muc" id="filter_danh_muc" value="{{ $selectedCategory ?? 'all' }}">
                
                @if(!empty($searchKeyword))
                    <input type="hidden" name="search" id="filter_search" value="{{ $searchKeyword }}">
                @endif

                <div class="filter-options-group">
                    <select name="gia" id="filter_gia" class="filter-select">
                        <option value="">Giá (Tất cả)</option>
                        <option value="duoi-5tr" {{ ($priceFilter ?? '') === 'duoi-5tr' ? 'selected' : '' }}>Dưới 4.500.000đ</option>
                        <option value="5tr-10tr" {{ ($priceFilter ?? '') === '5tr-10tr' ? 'selected' : '' }}>4.500.000đ - 10.000.000đ</option>
                        <option value="tren-10tr" {{ ($priceFilter ?? '') === 'tren-10tr' ? 'selected' : '' }}>Trên 10.000.000đ</option>
                    </select>

                    <select name="chat_lieu" id="filter_chat_lieu" class="filter-select">
                        <option value="all">Chất liệu (Tất cả)</option>
                        @foreach($materials as $mat)
                            <option value="{{ $mat }}" {{ ($materialFilter ?? '') === $mat ? 'selected' : '' }}>
                                {{ $mat }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" id="filter_sort" class="filter-select">
                        <option value="">Sắp xếp (Mặc định)</option>
                        <option value="gia-thap-cao" {{ ($sortFilter ?? '') === 'gia-thap-cao' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                        <option value="gia-cao-thap" {{ ($sortFilter ?? '') === 'gia-cao-thap' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                    </select>
                </div>
            </form>

            <span class="products-count">Hiển thị {{ $products->total() }} sản phẩm</span>
        </div>

        <div class="products-grid">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="no-product-message">
                    <p>Hiện tại chưa có sản phẩm nào thuộc bộ lọc này.</p>
                </div>
            @endforelse
        </div>

        <x-pagination :paginator="$products"/>

    </main>
</div>
<script src="{{ asset('js/listproduct.js') }}"></script>
@endsection