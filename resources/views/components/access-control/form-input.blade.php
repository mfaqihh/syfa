{{-- Form Input Component --}}
@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'helpText' => null,
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input 
        type="{{ $type }}" 
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}" 
        wire:model="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    />
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if($helpText)
        <small class="text-muted">{{ $helpText }}</small>
    @endif
</div>
