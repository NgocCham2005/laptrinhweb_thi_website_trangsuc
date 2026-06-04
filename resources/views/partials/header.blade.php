<header class="header">
    <div class="top-header" id="topHeader">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>
        <x-search-bar />
        <div class="header-right">
            @auth
    <a href="{{ route('cart.index') }}" class="cart">
        <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
    </a>
@else
    <a href="{{ route('login') }}" class="cart">
        <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
    </a>
@endauth
         
          {{-- USER ICON --}}
    @auth
           <a href="/profile" class="user-icon" title="{{ Auth::user()->HoTen }}">
              <i class="fa-solid fa-circle-user"></i>
           </a>
     @else
           <a href="{{ route('login') }}">Đăng nhập</a>
@endauth
        </div>
    </div>
</header>

<div class="sticky-header" id="stickyHeader">
    <div class="navbar">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
            Trang chủ
        </a>
        <a href="/products" class="{{ request()->is('products') ? 'active' : '' }}">
            Sản phẩm
        </a>
        @auth
            <a href="{{ route('order.lichSu') }}" class="{{ request()->is('don-hang*') ? 'active' : '' }}">
                Đơn hàng
            </a>
        @else
            <a href="/login" class="{{ request()->is('don-hang*') ? 'active' : '' }}">
                Đơn hàng
            </a>
        @endauth
    </div>
    <div class="policy-bar">
        <div>SẢN PHẨM CHẤT LƯỢNG</div>
        <div>HỖ TRỢ 24/7</div>
        <div>ƯU ĐÃI VẬN CHUYỂN</div>
    </div>
</div>