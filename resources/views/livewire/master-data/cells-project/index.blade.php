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

    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">
                        <i class="ti ti-{{ $isEdit ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEdit ? 'Edit' : 'Tambah' }} Cells Project
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="nama_cells_project" class="form-label">
                                Nama Cells Project <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_cells_project"
                                class="form-control @error('nama_cells_project') is-invalid @enderror"
                                wire:model="nama_cells_project"
                                placeholder="Contoh: Cells Project 1, Cells Project 2, dll" />
                            @error('nama_cells_project')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nama_pic" class="form-label">
                                Nama PIC <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" id="nama_pic"
                                    class="form-control @error('nama_pic') is-invalid @enderror" wire:model="nama_pic"
                                    placeholder="Contoh: PIC 1, PIC 2, dll" />
                                <span class="input-group-text">%</span>
                                @error('nama_pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Nama PIC untuk Cells Project ini</small>
                        </div>

                        <div class="mb-4">
                            <label for="tanda_tangan_pic" class="form-label">
                                Tanda Tangan PIC <span class="text-danger">*</span>
                            </label>
                            <input type="file" id="tanda_tangan_pic"
                                class="form-control @error('tanda_tangan_pic') is-invalid @enderror"
                                wire:model="tanda_tangan_pic" />
                            @error('tanda_tangan_pic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Unggah file tanda tangan untuk PIC ini (format: .png, .jpg,
                                .jpeg)
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                wire:model="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi_bidang" class="form-label">
                                Deskripsi Bidang <span class="text-danger">*</span>
                            </label>
                            <textarea id="deskripsi_bidang" class="form-control @error('deskripsi_bidang') is-invalid @enderror"
                                wire:model="deskripsi_bidang" rows="3"
                                placeholder="Masukkan deskripsi bidang"></textarea>
                            @error('deskripsi_bidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
