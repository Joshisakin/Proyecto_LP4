@props([
    'name',
    'label' => null,
    'icon' => null,
    'help' => null,
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        @if($icon)
            <i class="fas fa-{{ $icon }} me-2"></i>
        @endif
        {{ $label }}
    </label>

    {{ $slot }}

    @if($help)
        <div class="form-text text-muted">
            <small>{{ $help }}</small>
        </div>
    @endif

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
