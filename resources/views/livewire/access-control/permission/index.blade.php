<div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div class="d-flex flex-column justify-content-center">
            <h1 class="mb-1 fw-bold">Permission Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>Access Control</span>
                    </li>
                    <li class="breadcrumb-item active">Permission</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPermission"
                wire:click="resetForm">
                <i class="ti ti-plus me-1"></i> Tambah Permission
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Permission</h5>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-merge" style="width: 250px;">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari permission..."
                            wire:model.live.debounce.300ms="search" />
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Permission</th>
                        <th>Digunakan oleh Role</th>
                        <th>Dibuat</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $index => $permission)
                        <tr>
                            <td>{{ $permissions->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-label-secondary">{{ $permission->name }}</span>
                            </td>
                            <td>
                                @if ($permission->roles->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($permission->roles->take(3) as $role)
                                            <span class="badge bg-label-primary">{{ $role->name }}</span>
                                        @endforeach
                                        @if ($permission->roles->count() > 3)
                                            <span class="badge bg-label-info">+{{ $permission->roles->count() - 3 }}
                                                lainnya</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">Tidak digunakan</span>
                                @endif
                            </td>
                            <td>{{ $permission->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                        wire:click="edit({{ $permission->id }})" data-bs-toggle="modal"
                                        data-bs-target="#modalAddPermission">
                                        <i class="ti ti-pencil ti-md"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                        wire:click="deleteConfirm({{ $permission->id }})">
                                        <i class="ti ti-trash ti-md"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ti ti-key-off ti-3x text-muted mb-2"></i>
                                    <span class="text-muted">Tidak ada data permission ditemukan</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($permissions->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $permissions->links() }}
            </div>
        @endif
    </div>

    {{-- Modal Add/Edit Permission --}}
    <div class="modal fade" id="modalAddPermission" tabindex="-1" aria-labelledby="modalAddPermissionLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPermissionLabel">
                        {{ $editMode ? 'Edit Permission' : 'Tambah Permission Baru' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Permission <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model="name" placeholder="contoh: user.create, user.view" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Gunakan format: module.action (contoh: user.create,
                                role.edit)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="save">
                                {{ $editMode ? 'Update' : 'Simpan' }}
                            </span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Delete Confirmation --}}
    <div class="modal fade" id="modalDeletePermission" tabindex="-1" aria-labelledby="modalDeletePermissionLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeletePermissionLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="ti ti-alert-triangle ti-3x text-warning mb-3"></i>
                    <p class="mb-0">Apakah Anda yakin ingin menghapus permission ini?</p>
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
</div>

@script
    <script>
        $wire.on('closeModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAddPermission'));
            if (modal) modal.hide();
        });

        $wire.on('openDeleteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('modalDeletePermission'));
            modal.show();
        });

        $wire.on('closeDeleteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalDeletePermission'));
            if (modal) modal.hide();
        });
    </script>
@endscript
