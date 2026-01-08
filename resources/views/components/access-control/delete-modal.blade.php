{{-- Delete Modal Component --}}
@props([
    'id',
    'entity' => 'data',
])

<div 
    class="modal fade" 
    id="{{ $id }}" 
    tabindex="-1" 
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true" 
    wire:ignore.self
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="ti ti-alert-triangle ti-3x text-warning mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus {{ $entity }} ini?</p>
                <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" wire:click="confirmDelete">
                    <span wire:loading.remove wire:target="confirmDelete">Hapus</span>
                    <span wire:loading wire:target="confirmDelete">
                        <span class="spinner-border spinner-border-sm me-1"></span> Menghapus...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
