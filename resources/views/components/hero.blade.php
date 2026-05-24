@once
    @push('styles')
    <style>
        .lj-hero {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 320px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
        }


        /* Ảnh nền */
        .lj-hero__bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }


        /* Lớp phủ tối */
        .lj-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(15, 20, 35, 0.52);
            z-index: 1;
        }


        /* Logo góc dưới trái */
        .lj-hero__logo {
            position: absolute;
            bottom: 28px;
            left: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Playfair Display', serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #fff;
            opacity: 0.75;
            z-index: 2;
        }


        /* Nội dung giữa */
        .lj-hero__content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 48px 32px;
        }


        .lj-hero__tagline {
            font-size: clamp(14px, 1.8vw, 18px);
            color: #fff;
            line-height: 2;
            font-weight: 300;
            letter-spacing: 0.5px;
            margin: 0;
            font-family: 'Be Vietnam Pro', sans-serif;
            text-shadow: 0 1px 8px rgba(0,0,0,0.4);
        }


        /* Chữ Hán góc dưới phải */
        .lj-hero__cjk {
            position: absolute;
            bottom: 28px;
            right: 40px;
            font-size: 20px;
            color: #fff;
            opacity: 0.75;
            letter-spacing: 10px;
            font-family: serif;
            z-index: 2;
            text-shadow: 0 1px 8px rgba(0,0,0,0.4);
        }


        @media (max-width: 640px) {
            .lj-hero { min-height: 240px; }
            .lj-hero__cjk { letter-spacing: 5px; font-size: 15px; }
            .lj-hero__content { padding: 40px 20px 60px; }
        }
    </style>
    @endpush
@endonce


@props([
    'tagline' => "It was a lovely meeting.\nTo be the only one in each other's lives.\nFind slow happiness.",
    'cjk'     => 'Nhẫn cưới',
    'image'   => 'https://www.tierra.vn/wp-content/uploads/2025/05/vang-trang-suc-la-vang-gi-hinh-anh-trang-suc-vang-dep.jpg',
])


<section class="lj-hero">
    {{-- Ảnh nền --}}
    <img class="lj-hero__bg" src="{{ asset($image) }}" alt="Hero background">


    {{-- Logo --}}
    <div class="lj-hero__logo">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <polygon points="12,2 22,8 12,22 2,8" fill="none" stroke="white" stroke-width="1.5"/>
            <line x1="2" y1="8" x2="22" y2="8" stroke="white" stroke-width="1"/>
        </svg>
        LUMINOUS JEWELRY
    </div>


    {{-- Tagline giữa --}}
    <div class="lj-hero__content">
        <p class="lj-hero__tagline">
            @foreach(explode("\n", $tagline) as $line)
                {{ $line }}<br>
            @endforeach
        </p>
    </div>


    {{-- Chữ Hán --}}
    <div class="lj-hero__cjk">{{ $cjk }}</div>
</section>
