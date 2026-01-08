<div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div class="d-flex flex-column justify-content-center">
            <h1 class="mb-1 fw-bold">Role Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>Access Control</span>
                    </li>
                    <li class="breadcrumb-item active">Role</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddRole"
                wire:click="resetForm">
                <i class="ti ti-plus me-1"></i> Tambah Role
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
                <h5 class="card-title mb-0">Daftar Role</h5>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-merge" style="width: 250px;">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari role..."
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
                        <th>Nama Role</th>
                        <th>Permissions</th>
                        <th>Jumlah User</th>
                        <th>Dibuat</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $index => $role)
                        <tr>
                            <td>{{ $roles->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-label-primary">{{ $role->name }}</span>
                            </td>
                            <td>
                                @if ($role->permissions->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-1" style="max-width: 400px;">
                                        @foreach ($role->permissions->take(3) as $permission)
                                            <span class="badge bg-label-secondary">{{ $permission->name }}</span>
                                        @endforeach
                                        @if ($role->permissions->count() > 3)
                                            <span class="badge bg-label-info">+{{ $role->permissions->count() - 3 }}
                                                lainnya</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">Tidak ada permission</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-label-info">{{ $role->users_count }} user</span>
                            </td>
                            <td>{{ $role->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                        wire:click="edit({{ $role->id }})" data-bs-toggle="modal"
                                        data-bs-target="#modalAddRole">
                                        <i class="ti ti-pencil ti-md"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                        wire:click="deleteConfirm({{ $role->id }})">
                                        <i class="ti ti-trash ti-md"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ti ti-shield-off ti-3x text-muted mb-2"></i>
                                    <span class="text-muted">Tidak ada data role ditemukan</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($roles->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $roles->links() }}
            </div>
        @endif
    </div>

    {{-- Modal Add/Edit Role --}}
    <div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddRoleLabel">
                        {{ $editMode ? 'Edit Role' : 'Tambah Role Baru' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Role <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model="name" placeholder="Masukkan nama role" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @foreach ($permissions->groupBy(function ($permission) {
        return explode('.', $permission->name)[0] ?? 'other';
    }) as $group => $groupPermissions)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border shadow-none">
                                            <div class="card-header py-2 bg-light">
                                                <strong class="text-capitalize">{{ $group }}</strong>
                                            </div>
                                            <div class="card-body py-2">
                                                @foreach ($groupPermissions as $permission)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="perm_{{ $permission->id }}"
                                                            value="{{ $permission->name }}"
                                                            wire:model="selectedPermissions" />
                                                        <label class="form-check-label"
                                                            for="perm_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button>
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
    <div class="modal fade" id="modalDeleteRole" tabindex="-1" aria-labelledby="modalDeleteRoleLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteRoleLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="ti ti-alert-triangle ti-3x text-warning mb-3"></i>
                    <p class="mb-0">Apakah Anda yakin ingin menghapus role ini?</p>
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAddRole'));
            if (modal) modal.hide();
        });

        $wire.on('openDeleteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('modalDeleteRole'));
            modal.show();
        });

        $wire.on('closeDeleteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalDeleteRole'));
            if (modal) modal.hide();
        });
    </script>
@endscript
