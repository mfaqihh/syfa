<div class="d-flex gap-1">
    <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
        wire:click="$parent.edit('{{ $id }}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <i class="ti ti-pencil ti-md"></i>
    </button>
    <button type="button" class="btn btn-sm btn-icon btn-text-danger rounded-pill"
        wire:click="$parent.deleteConfirm('{{ $id }}')" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus">
        <i class="ti ti-trash ti-md"></i>
    </button>
</div>
