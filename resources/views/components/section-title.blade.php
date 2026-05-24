<!-- @once
    @push('styles')
    <style>
        .lj-section-title {
            margin-bottom: 48px;
        }
        .lj-section-title--center { text-align: center; }
        .lj-section-title--left   { text-align: left; }
        .lj-section-title__eyebrow {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 10px;
            font-family: 'Be Vietnam Pro', sans-serif;
        }
        .lj-section-title__heading {
            font-family: 'Playfair Display', serif;
            font-size: clamp(22px, 3vw, 34px);
            font-weight: 700;
            color: #15264b;
            line-height: 1.25;
            margin: 0 0 16px;
        }
        .lj-section-title--dark .lj-section-title__heading { color: #fff; }
        .lj-section-title__divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .lj-section-title--center .lj-section-title__divider { justify-content: center; }
        .lj-section-title--left   .lj-section-title__divider { justify-content: flex-start; }
        .lj-section-title__line {
            display: block;
            width: 60px;
            height: 1px;
            background: #D4AF37;
            opacity: 0.5;
        }
        .lj-section-title__diamond {
            display: block;
            width: 7px;
            height: 7px;
            background: #D4AF37;
            transform: rotate(45deg);
            flex-shrink: 0;
        }
        .lj-section-title__desc {
            font-size: 14px;
            line-height: 1.8;
            max-width: 480px;
            margin: 0 auto;
            opacity: 0.7;
            color: #15264b;
            font-family: 'Be Vietnam Pro', sans-serif;
        }
        .lj-section-title--dark .lj-section-title__desc { color: #fff; }
        .lj-section-title--left .lj-section-title__desc  { margin-left: 0; }
    </style>
    @endpush
@endonce -->


@props([
    'eyebrow'     => null,
    'title'       => 'Tiêu đề',
    'description' => null,
    'align'       => 'center',
    'theme'       => 'light',
])


<div class="lj-section-title lj-section-title--{{ $align }} lj-section-title--{{ $theme }}">
    @if($eyebrow)
        <span class="lj-section-title__eyebrow">{{ $eyebrow }}</span>
    @endif


    <h2 class="lj-section-title__heading">{{ $title }}</h2>


    <div class="lj-section-title__divider" aria-hidden="true">
        <span class="lj-section-title__line"></span>
        <span class="lj-section-title__diamond"></span>
        <span class="lj-section-title__line"></span>
    </div>


    @if($description)
        <p class="lj-section-title__desc">{{ $description }}</p>
    @endif
</div>
