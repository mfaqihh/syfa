<div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-bold">Peminjaman Dana</h4>
            <p class="text-muted mb-0">
                <i class="ti ti-info-circle me-1"></i>
                Kelola data Peminjaman Dana disini.
            </p>
        </div>
        <a href="{{ route('peminjaman-dana.create') }}" class="btn btn-primary" wire:navigate.hover>
            <i class="ti ti-plus me-1"></i> Tambah Data
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                <i class="ti ti-list me-2"></i>Daftar Peminjaman Dana
            </h5>
        </div>
        <div class="card-body pt-4">
            <livewire:peminjaman-dana.datatable />
        </div>
    </div>
</div>
