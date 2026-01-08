{{-- Modal Footer Component --}}
@props([
    'editMode' => false,
    'saveLabel' => null,
    'cancelLabel' => 'Batal',
])

@php
    $defaultSaveLabel = $editMode ? 'Update' : 'Simpan';
    $label = $saveLabel ?? $defaultSaveLabel;
@endphp

<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        {{ $cancelLabel }}
    </button>
    <button type="submit" class="btn btn-primary">
        <span wire:loading.remove wire:target="save">{{ $label }}</span>
        <span wire:loading wire:target="save">
            <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
        </span>
    </button>
</div>
