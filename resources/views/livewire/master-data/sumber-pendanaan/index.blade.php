<div>
    <!-- Header -->
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-bold">Sumber Pendanaan Eksternal</h4>
            <p class="text-muted mb-0">
                <i class="ti ti-info-circle me-1"></i>
                Kelola data sumber pendanaan eksternal untuk pembiayaan
            </p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah Data
        </button>
    </div>

    <!-- Datatable Card -->
    <div class="card shadow-sm">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                <i class="ti ti-list me-2"></i>Daftar Sumber Pendanaan
            </h5>
        </div>
        <div class="card-body pt-4">
            <livewire:master-data.sumber-pendanaan-eksternal.datatable />
        </div>
    </div>

    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">
                        <i class="ti ti-{{ $isEdit ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEdit ? 'Edit' : 'Tambah' }} Sumber Pendanaan Eksternal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="nama_instansi" class="form-label">
                                Nama Instansi <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_instansi"
                                class="form-control @error('nama_instansi') is-invalid @enderror"
                                wire:model="nama_instansi" placeholder="Masukkan nama instansi" />
                            @error('nama_instansi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-0">
                            <label for="presentase_bagi_hasil" class="form-label">
                                Presentase Bagi Hasil (%) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" id="presentase_bagi_hasil"
                                    class="form-control @error('presentase_bagi_hasil') is-invalid @enderror"
                                    wire:model="presentase_bagi_hasil" placeholder="0.00" step="0.01" min="0"
                                    max="100" />
                                <span class="input-group-text">%</span>
                                @error('presentase_bagi_hasil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Masukkan nilai antara 0 - 100</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            <i class="ti ti-x me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="save">
                                <i class="ti ti-check me-1"></i> {{ $isEdit ? 'Perbarui' : 'Simpan' }}
                            </span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <div class="mb-4">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-danger">
                                <i class="ti ti-alert-triangle ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-2">Konfirmasi Hapus</h4>
                        <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat
                            dibatalkan.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger" wire:click="confirmDelete" data-bs-dismiss="modal">
                        <span wire:loading.remove wire:target="confirmDelete">
                            <i class="ti ti-trash me-1"></i> Hapus
                        </span>
                        <span wire:loading wire:target="confirmDelete">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Menghapus...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        // Modal controls
        $wire.on('closeModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
            if (modal) modal.hide();
        });

        $wire.on('openModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('formModal'));
            modal.show();
        });

        $wire.on('openDeleteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });

        $wire.on('closeDeleteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            if (modal) modal.hide();
        });
    </script>
@endscript
