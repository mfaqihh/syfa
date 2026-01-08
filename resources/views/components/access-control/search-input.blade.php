{{-- Search Input Component --}}
@props([
    'placeholder' => 'Cari...',
    'width' => '250px',
])

<div class="d-flex gap-2">
    <div class="input-group input-group-merge" style="width: {{ $width }};">
        <span class="input-group-text"><i class="ti ti-search"></i></span>
        <input 
            type="text" 
            class="form-control" 
            placeholder="{{ $placeholder }}"
            wire:model.live.debounce.300ms="search" 
        />
    </div>
</div>
