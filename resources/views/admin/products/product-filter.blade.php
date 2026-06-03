<form action="{{ route('admin.products') }}" method="GET" class="product-inline-filter">
    <div class="filter-flex-container">
        
        <div class="filter-field field-search">
            <input type="text" name="search" value="{{ request('search') }}" class="filter-input-control" placeholder="Nhập mã hoặc tên sản phẩm...">
        </div>

        <div class="filter-field field-select">
            <select name="category_id" class="filter-input-control">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->MaDanhMuc }}" {{ request('category_id') == $cat->MaDanhMuc ? 'selected' : '' }}>
                        {{ $cat->TenDanhMuc }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-field field-select">
            <select name="status" class="filter-input-control">
                <option value="">Tất cả trạng thái</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <div class="filter-field field-select">
            <select name="stock_status" class="filter-input-control">
                <option value="">Tình trạng tồn kho</option>
                <option value="instock" {{ request('stock_status') == 'instock' ? 'selected' : '' }}>Còn hàng (SL > 0)</option>
                <option value="outofstock" {{ request('stock_status') == 'outofstock' ? 'selected' : '' }}>Hết hàng (SL = 0)</option>
            </select>
        </div>

        <div class="filter-buttons-group">
            <x-button type="submit" variant="secondary">
                Tra cứu
            </x-button>
        <a href="{{ route('admin.products') }}">
                <x-button type="button" variant="primary" :block="true">
                    Xóa bộ lọc
                </x-button>
            </a>
        </div>

    </div>
</form>