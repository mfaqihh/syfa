<div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-bold">Cells Project</h4>
            <p class="text-muted mb-0">
                <i class="ti ti-info-circle me-1"></i>
                Kelola data Cells Project disini.
            </p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah Data
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                <i class="ti ti-list me-2"></i>Daftar Cells Project
            </h5>
        </div>  
        <div class="card-body pt-4">
            <livewire:master-data.cells-project.datatable />
        </div>
    </div>
</div>
