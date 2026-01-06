<div>
    <!-- Header -->
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-bold">KOL Configuration</h4>
            <p class="text-muted mb-0">
                <i class="ti ti-info-circle me-1"></i>
                Kelola konfigurasi Kolektibilitas (KOL) untuk penentuan status pembiayaan
            </p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah KOL
        </button>
    </div>

    <!-- Info Cards -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-chart-pie-2 ti-md"></i>
                            </span>
                        </div>
                        <h4 class="mb-0">KOL 1</h4>
                    </div>
                    <p class="text-muted mb-0 small">Lancar (0 hari keterlambatan)</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ti ti-alert-triangle ti-md"></i>
                            </span>
                        </div>
                        <h4 class="mb-0">KOL 2-3</h4>
                    </div>
                    <p class="text-muted mb-0 small">Dalam Perhatian Khusus</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="ti ti-alert-circle ti-md"></i>
                            </span>
                        </div>
                        <h4 class="mb-0">KOL 4-5</h4>
                    </div>
                    <p class="text-muted mb-0 small">Kurang Lancar / Macet</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="ti ti-settings ti-md"></i>
                            </span>
                        </div>
                        <h4 class="mb-0">Konfigurasi</h4>
                    </div>
                    <p class="text-muted mb-0 small">Atur presentase & hari</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Datatable Card -->
    <div class="card shadow-sm">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                <i class="ti ti-list me-2"></i>Daftar Konfigurasi KOL
            </h5>
        </div>
        <div class="card-body pt-4">
            <livewire:master-data.kol-configuration.datatable />
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
                        {{ $isEdit ? 'Edit' : 'Tambah' }} Konfigurasi KOL
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="kol" class="form-label">
                                KOL <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kol" class="form-control @error('kol') is-invalid @enderror"
                                wire:model="kol" placeholder="Contoh: KOL 1, KOL 2, dll" />
                            @error('kol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="presentase_pencairan" class="form-label">
                                Presentase Pencairan (%) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" id="presentase_pencairan"
                                    class="form-control @error('presentase_pencairan') is-invalid @enderror"
                                    wire:model="presentase_pencairan" placeholder="0.00" step="0.01" min="0"
                                    max="100" />
                                <span class="input-group-text">%</span>
                                @error('presentase_pencairan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Presentase pencairan untuk KOL ini</small>
                        </div>

                        <div class="mb-0">
                            <label for="jumlah_hari_keterlambatan" class="form-label">
                                Jumlah Hari Keterlambatan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" id="jumlah_hari_keterlambatan"
                                    class="form-control @error('jumlah_hari_keterlambatan') is-invalid @enderror"
                                    wire:model="jumlah_hari_keterlambatan" placeholder="0" min="0" />
                                <span class="input-group-text">hari</span>
                                @error('jumlah_hari_keterlambatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Batas maksimal hari keterlambatan untuk KOL ini</small>
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
                        <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus data KOL ini? Tindakan ini tidak
                            dapat dibatalkan.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger" wire:click="confirmDelete"
                        data-bs-dismiss="modal">
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
