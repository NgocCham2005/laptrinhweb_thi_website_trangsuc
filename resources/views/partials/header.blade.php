<header class="header">
    <div class="top-header" id="topHeader">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>
        <x-search-bar />
        <div class="header-right">
            <a href="{{ route('cart.index') }}" class="cart">
    <i class="fa-solid fa-cart-shopping"></i>
    Giỏ hàng
</a>
            <a href="/login">Đăng nhập</a>
        </div>
    </div>
</header>

    <div class="sticky-header" id="stickyHeader">
        <div class="navbar">
            <a href="/"
                class="{{ request()->is('/') ? 'active' : '' }}">
                Trang chủ
            </a>
            <a href="/products"
                class="{{ request()->is('products') ? 'active' : '' }}">
                Sản phẩm
            </a>
           <a href="{{ route('order.lichSu') }}"
    class="{{ request()->is('don-hang*') ? 'active' : '' }}">
    Đơn hàng
</a>
        </div>
        <div class="policy-bar">
            <div>SẢN PHẨM CHẤT LƯỢNG</div>
            <div>HỖ TRỢ 24/7</div>
            <div>ƯU ĐÃI VẬN CHUYỂN</div>
        </div>
    </div>