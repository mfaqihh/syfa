{{-- Action Buttons Component --}}
@props([
    'id',
    'modalTarget' => null,
    'showEdit' => true,
    'showDelete' => true,
])

<div class="d-flex gap-1">
    @if($showEdit)
        <button 
            type="button" 
            class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
            wire:click="edit({{ is_string($id) ? "'{$id}'" : $id }})"
            @if($modalTarget) data-bs-toggle="modal" data-bs-target="#{{ $modalTarget }}" @endif
            title="Edit"
        >
            <i class="ti ti-pencil ti-md"></i>
        </button>
    @endif
    
    @if($showDelete)
        <button 
            type="button" 
            class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
            wire:click="deleteConfirm({{ is_string($id) ? "'{$id}'" : $id }})"
            title="Hapus"
        >
            <i class="ti ti-trash ti-md"></i>
        </button>
    @endif
</div>
