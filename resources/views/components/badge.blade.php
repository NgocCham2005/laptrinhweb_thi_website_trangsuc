@props([
    'variant' => 'gray',
])

<span {{ $attributes->merge(['class' => "badge badge-{$variant}"]) }}>
    {{ $slot }}
</span>