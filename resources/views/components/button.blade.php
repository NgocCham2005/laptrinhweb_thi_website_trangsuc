@props([
    'type'     => 'button',
    'variant'  => 'primary',
    'size'     => 'md',
    'block'    => false,
    'disabled' => false,
    'icon'     => null,
])

@php
    $sizeClass  = $size === 'sm' ? 'btn-sm' : ($size === 'lg' ? 'btn-lg' : ($size === 'xl' ? 'btn-xl' : ''));
    $blockClass = $block ? 'btn-block' : '';
@endphp

<button
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => "btn btn-{$variant} {$sizeClass} {$blockClass}"]) }}
>
    @if($icon)
        <span class="btn-icon-left">{{ $icon }}</span>
    @endif
    <span style="position:relative; z-index:2;">{{ $slot }}</span>
</button>