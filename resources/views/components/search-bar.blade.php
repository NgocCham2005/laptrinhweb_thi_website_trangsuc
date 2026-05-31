<form action="{{ route('products.index') }}" method="GET" class="search-box" id="filterForm">
    @if(request('danh_muc'))
        <input type="hidden" name="danh_muc" value="{{ request('danh_muc') }}">
    @endif
    @if(request('gia'))
        <input type="hidden" name="gia" value="{{ request('gia') }}">
    @endif
    @if(request('chat_lieu'))
        <input type="hidden" name="chat_lieu" value="{{ request('chat_lieu') }}">
    @endif

    <input type="text" name="search" value="{{ request('search') ?? '' }}" placeholder="Tìm kiếm sản phẩm...">
    
    <button type="submit">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form>