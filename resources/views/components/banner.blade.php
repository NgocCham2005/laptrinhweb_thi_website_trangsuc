 <!-- @once 
    @push('styles')
    <style>
        .lj-banner {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;        /* căn giữa nội dung */
            min-height: 320px;              /* cao hơn: 220 → 320 */
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
        }


        .lj-banner__bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }


        /* Nền sáng hơn: giảm opacity từ 0.82 → 0.60 */
        .lj-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(21,38,75,0.45) 0%, rgba(21,38,75,0.20) 55%, rgba(21,38,75,0.05) 100%);
            z-index: 1;
        }


        /* Logo to hơn: 12px → 15px, letter-spacing rộng hơn */
        .lj-banner__logo {
            position: absolute;
            top: 24px;
            right: 36px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Playfair Display', serif;
            font-size: 15px;                /* to hơn */
            font-weight: 700;
            letter-spacing: 4px;            /* rộng hơn */
            color: #fff;
            opacity: 0.90;                  /* rõ hơn */
            z-index: 2;
        }


        /* Nội dung căn giữa */
        .lj-banner__content {
            position: relative;
            z-index: 2;
            padding: 40px 48px;
            text-align: center;             /* căn giữa chữ */
        }


        .lj-banner__title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 700;
            color: #fff;
            margin: 0 0 20px;
            line-height: 1.2;
        }


        .lj-banner__offer-label {
            display: block;
            font-size: 20px;
            color: #D4AF37;
            margin-bottom: 2px;
            font-family: 'Be Vietnam Pro', sans-serif;
            letter-spacing: 1px;
        }


        .lj-banner__offer-percent {
            display: block;
            font-size: clamp(60px, 8vw, 90px);
            font-weight: 700;
            color: #fff;
            line-height: 1;
            font-family: 'Be Vietnam Pro', sans-serif;
        }


        .lj-banner__date {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            margin-top: 8px;
            margin-bottom: 28px;
            font-family: 'Be Vietnam Pro', sans-serif;
        }


        .lj-banner__btn {
            display: inline-block;
            background: #D4AF37;
            color: #15264b;
            padding: 13px 36px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            font-family: 'Be Vietnam Pro', sans-serif;
            letter-spacing: 0.5px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(212,175,55,0.35);
        }


        .lj-banner__btn:hover {
            background: #c9a227;
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(212,175,55,0.45);
        }


        @media (max-width: 640px) {
            .lj-banner__content { padding: 36px 24px; }
            .lj-banner::after { background: rgba(21,38,75,0.55); }
        }
    </style>
    @endpush
@endonce -->

<head>
    <meta charset="UTF-8">
    <title>Luminous Jewelry</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

@props([
    'title'    => 'Trang sức bạc nữ',
    'discount' => '20%',
    'dateFrom' => '1/6',
    'dateTo'   => '30/6',
    'link'     => '#',
    'image'    => 'https://photo.znews.vn/w660/Uploaded/wyhktpu/2016_07_26/10.png',
])


<section class="lj-banner">
    <img class="lj-banner__bg" src="{{ asset($image) }}" alt="{{ $title }}">


    <div class="lj-banner__logo">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <polygon points="12,2 22,8 12,22 2,8" fill="none" stroke="white" stroke-width="1.5"/>
            <line x1="2" y1="8" x2="22" y2="8" stroke="white" stroke-width="1"/>
        </svg>
        LUMINOUS JEWELRY
    </div>


    <div class="lj-banner__content">
        <h2 class="lj-banner__title">{{ $title }}</h2>
        <span class="lj-banner__offer-label">ưu đãi</span>
        <span class="lj-banner__offer-percent">{{ $discount }}</span>
        <p class="lj-banner__date">từ ngày {{ $dateFrom }} đến hết ngày {{ $dateTo }}</p>
        <a href="{{ $link }}" class="lj-banner__btn">Khám phá ngay</a>
    </div>
</section>
