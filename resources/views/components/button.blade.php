@props([
    'type' => 'button',
    'variant' => 'primary',
    'icon' => null,
    'size' => null,
    'href' => null
])

@php
    $classes = [
        'btn',
        'btn-' . $variant,
        $size ? 'btn-' . $size : '',
    ];
    
    $tag = $href ? 'a' : 'button';
    $attrs = $href ? ['href' => $href] : ['type' => $type];
@endphp

<{{ $tag }} 
    {{ $attributes->merge(['class' => implode(' ', array_filter($classes))])->merge($attrs) }}>
    @if($icon)
        <i class="fas fa-{{ $icon }} me-2"></i>
    @endif
    {{ $slot }}
</{{ $tag }}>
