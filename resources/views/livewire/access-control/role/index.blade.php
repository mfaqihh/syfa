<div>
    {{-- Page Header --}}
    <x-access-control.page-header 
        title="Role Management"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'route' => 'dashboard'],
            ['label' => 'Access Control'],
            ['label' => 'Role', 'active' => true],
        ]"
    >
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddRole"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah Role
        </button>
    </x-access-control.page-header>

    {{-- Data Card --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Role</h5>
                <x-access-control.search-input placeholder="Cari role..." />
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
                    @forelse($this->roles as $index => $role)
                        <tr wire:key="role-{{ $role->id }}">
                            <td>{{ $this->roles->firstItem() + $index }}</td>
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
                                            <span class="badge bg-label-info">
                                                +{{ $role->permissions->count() - 3 }} lainnya
                                            </span>
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
                                <x-access-control.action-buttons 
                                    :id="$role->id"
                                    modal-target="modalAddRole"
                                />
                            </td>
                        </tr>
                    @empty
                        <x-access-control.empty-state 
                            colspan="6" 
                            icon="ti-shield-off" 
                            message="Tidak ada data role ditemukan" 
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <x-access-control.pagination :paginator="$this->roles" />
    </div>

    {{-- Modal Add/Edit Role --}}
    <x-access-control.modal 
        id="modalAddRole" 
        :title="$editMode ? 'Edit Role' : 'Tambah Role Baru'"
        size="modal-lg"
    >
        <form wire:submit="save">
            <div class="modal-body">
                <div class="mb-4">
                    <label for="name" class="form-label">
                        Nama Role <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror"
                        id="name" 
                        wire:model="name" 
                        placeholder="Masukkan nama role" 
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="row">
                        @foreach ($this->groupedPermissions as $group => $groupPermissions)
                            <div class="col-md-6 mb-3">
                                <div class="card border shadow-none">
                                    <div class="card-header py-2 bg-light">
                                        <strong class="text-capitalize">{{ $group }}</strong>
                                    </div>
                                    <div class="card-body py-2">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="form-check mb-1">
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox"
                                                    id="perm_{{ $permission->id }}"
                                                    value="{{ $permission->name }}"
                                                    wire:model="selectedPermissions" 
                                                />
                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
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
            <x-access-control.modal-footer :edit-mode="$editMode" />
        </form>
    </x-access-control.modal>

    {{-- Modal Delete Confirmation --}}
    <x-access-control.delete-modal 
        id="modalDeleteRole" 
        entity="role" 
    />
</div>

@script
<script>
    // Modal event handlers
    $wire.on('closeModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalAddRole'))?.hide();
    });

    $wire.on('openDeleteModal', () => {
        new bootstrap.Modal(document.getElementById('modalDeleteRole')).show();
    });

    $wire.on('closeDeleteModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalDeleteRole'))?.hide();
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
