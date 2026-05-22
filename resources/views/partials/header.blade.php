<header class="header">

    <!-- ===== TOP HEADER ===== -->
    <div class="top-header">

        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="">
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
            <a href="" class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                Giỏ hàng
            </a>
            <a href="">Đăng nhập</a>
            <a href="">Đăng ký</a>
        </div>
    </div>

    <!-- ===== NAVBAR ===== -->
    <div class="navbar">
        <a href="/"
            class="{{ request()->routeIs('home') ? 'active' : '' }}">
            Trang chủ
        </a>
        <a href="/products"
            class="{{ request()->routeIs('products') ? 'active' : '' }}">
            Sản phẩm
        </a>
    </div>

    <!-- ===== POLICY ===== -->
    <div class="policy-bar">
        <div>SẢN PHẨM CHẤT LƯỢNG</div>
        <div>HỖ TRỢ 24/7</div>
        <div>ƯU ĐÃI VẬN CHUYỂN</div>
    </div>

</header>