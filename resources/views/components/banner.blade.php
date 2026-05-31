@php
    $banners = \App\Models\Banner::where('TrangThai', 1)
        ->orderBy('MaBanner')
        ->take(5)
        ->get();

    $slideBanners = $banners->take(3);
    $topBanner = $banners->get(3);
    $bottomBanner = $banners->get(4);
@endphp

<section class="home-banner-layout">

    {{-- Banner lớn bên trái --}}
    <div class="banner-main">

        @foreach($slideBanners as $index => $banner)
            <img
                src="{{ asset('images/banners/' . $banner->HinhAnh) }}"
                alt="{{ $banner->TenBanner }}"
                class="banner-slide {{ $index === 0 ? 'active' : '' }}"
            >
        @endforeach

    </div>

    {{-- Banner bên phải --}}
    <div class="banner-side">

        @if($topBanner)
            <div class="banner-small">
                <img
                    src="{{ asset('images/banners/' . $topBanner->HinhAnh) }}"
                    alt="{{ $topBanner->TenBanner }}"
                >
            </div>
        @endif

        @if($bottomBanner)
            <div class="banner-small">
                <img
                    src="{{ asset('images/banners/' . $bottomBanner->HinhAnh) }}"
                    alt="{{ $bottomBanner->TenBanner }}"
                >
            </div>
        @endif

    </div>

</section>