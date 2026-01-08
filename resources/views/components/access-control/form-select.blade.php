{{-- Form Select Component --}}
@props([
    'name',
    'label',
    'options' => [],
    'placeholder' => 'Pilih...',
    'required' => false,
    'optionValue' => 'id',
    'optionLabel' => 'name',
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select 
        class="form-select @error($name) is-invalid @enderror" 
        id="{{ $name }}"
        wire:model="{{ $name }}"
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            @if(is_array($option) || is_object($option))
                <option value="{{ data_get($option, $optionValue) }}">
                    {{ data_get($option, $optionLabel) }}
                </option>
            @else
                <option value="{{ $option }}">{{ $option }}</option>
            @endif
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
