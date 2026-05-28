<header class="header">

    <!-- ===== TOP HEADER ===== -->
    <div class="top-header">

        <!-- LOGO -->
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>

        <!-- SEARCH -->
        <div class="search-box">
            <input type="text" placeholder="Tìm kiếm sản phẩm...">
            <button>
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>

        <!-- RIGHT MENU -->
        <div class="header-right">
            <a href="/cart" class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                Giỏ hàng
            </a>
            <a href="/login">Đăng nhập</a>
        </div>
    </div>

    <div class="bottom-header">
        <div class="navbar">
            <a href="/"
                class="{{ request()->is('/') ? 'active' : '' }}">
                Trang chủ
            </a>
            <a href="/products"
                class="{{ request()->is('products') ? 'active' : '' }}">
                Sản phẩm
            </a>
            <a href="/orders"
                class="{{ request()->is('orders') ? 'active' : '' }}">
                Đơn hàng
            </a>
        </div>
        <div class="policy-bar">
            <div>SẢN PHẨM CHẤT LƯỢNG</div>
            <div>HỖ TRỢ 24/7</div>
            <div>ƯU ĐÃI VẬN CHUYỂN</div>
        </div>
    </div>
</header>