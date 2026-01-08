<div>
    {{-- Page Header --}}
    <x-access-control.page-header 
        title="Permission Management"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'route' => 'dashboard'],
            ['label' => 'Access Control'],
            ['label' => 'Permission', 'active' => true],
        ]"
    >
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPermission"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah Permission
        </button>
    </x-access-control.page-header>

    {{-- Data Card --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Permission</h5>
                <x-access-control.search-input placeholder="Cari permission..." />
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
                    @forelse($this->permissions as $index => $permission)
                        <tr wire:key="permission-{{ $permission->id }}">
                            <td>{{ $this->permissions->firstItem() + $index }}</td>
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
                                            <span class="badge bg-label-info">
                                                +{{ $permission->roles->count() - 3 }} lainnya
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">Tidak digunakan</span>
                                @endif
                            </td>
                            <td>{{ $permission->created_at->format('d M Y') }}</td>
                            <td>
                                <x-access-control.action-buttons 
                                    :id="$permission->id"
                                    modal-target="modalAddPermission"
                                />
                            </td>
                        </tr>
                    @empty
                        <x-access-control.empty-state 
                            colspan="5" 
                            icon="ti-key-off" 
                            message="Tidak ada data permission ditemukan" 
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <x-access-control.pagination :paginator="$this->permissions" />
    </div>

    {{-- Modal Add/Edit Permission --}}
    <x-access-control.modal id="modalAddPermission" :title="$editMode ? 'Edit Permission' : 'Tambah Permission Baru'">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama Permission <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                        class="form-control @error('name') is-invalid @enderror"
                        id="name" 
                        wire:model="name" 
                        placeholder="contoh: user.create, user.view" 
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        Gunakan format: module.action (contoh: user.create, role.edit)
                    </small>
                </div>
            </div>
            <x-access-control.modal-footer :edit-mode="$editMode" />
        </form>
    </x-access-control.modal>

    {{-- Modal Delete Confirmation --}}
    <x-access-control.delete-modal 
        id="modalDeletePermission" 
        entity="permission" 
    />
</div>

@script
<script>
    // Modal event handlers
    $wire.on('closeModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalAddPermission'))?.hide();
    });

    $wire.on('openDeleteModal', () => {
        new bootstrap.Modal(document.getElementById('modalDeletePermission')).show();
    });

    $wire.on('closeDeleteModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalDeletePermission'))?.hide();
    });

    // Toast notifications
    $wire.on('toast', ({ type, message }) => {
        Swal.fire({
            icon: type === 'danger' ? 'error' : type,
            title: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    });
</script>
@endscript
