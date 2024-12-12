@props([
    'title' => null,
    'icon' => null,
    'headerClass' => 'bg-white',
])

<div {{ $attributes->merge(['class' => 'card shadow-sm']) }}>
    @if($title)
        <div class="card-header {{ $headerClass }}">
            <h5 class="card-title mb-0">
                @if($icon)
                    <i class="fas fa-{{ $icon }} me-2"></i>
                @endif
                {{ $title }}
            </h5>
        </div>
    @endif
    
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
