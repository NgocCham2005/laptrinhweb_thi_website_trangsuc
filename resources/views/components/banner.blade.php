@php
    $banners = DB::table('Banner')->where('TrangThai', 1)->get();
@endphp

<section class="banner">

    @foreach($banners as $index => $banner)
        <img
            class="banner-image {{ $index === 0 ? 'active' : '' }}"
            src="{{ asset('images/banner/' . $banner->HinhAnh) }}"
            alt="{{ $banner->TenBanner ?? '' }}"
        >
    @endforeach

</section>

<script>

    const bannerImages =
        document.querySelectorAll('.banner-image');

    let currentBanner = 0;

    setInterval(() => {

        bannerImages[currentBanner]
            .classList.remove('active');

        currentBanner++;

        if (currentBanner >= bannerImages.length) {
            currentBanner = 0;
        }

        bannerImages[currentBanner]
            .classList.add('active');

    }, 5000);

</script>
