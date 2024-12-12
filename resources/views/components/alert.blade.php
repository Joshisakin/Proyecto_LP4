@props(['type' => 'info'])

@php
    $classes = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'error' => 'alert-danger',
        'danger' => 'alert-danger'
    ];
@endphp

<div {{ $attributes->merge(['class' => 'alert ' . ($classes[$type] ?? 'alert-info')]) }} role="alert">
    {{ $slot }}
</div>
