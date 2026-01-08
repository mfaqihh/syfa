<div>
    {{-- Page Header --}}
    <x-access-control.page-header 
        title="User Management"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'route' => 'dashboard'],
            ['label' => 'Access Control'],
            ['label' => 'User', 'active' => true],
        ]"
    >
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddUser"
            wire:click="resetForm">
            <i class="ti ti-plus me-1"></i> Tambah User
        </button>
    </x-access-control.page-header>

    {{-- Data Card --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar User</h5>
                <x-access-control.search-input placeholder="Cari user..." />
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->users as $index => $user)
                        <tr wire:key="user-{{ $user->id_user }}">
                            <td>{{ $this->users->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if ($user->profile_photo_path)
                                            <img src="{{ Storage::url($user->profile_photo_path) }}" 
                                                alt="Avatar" class="rounded-circle" />
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="fw-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->roles as $role)
                                    <span class="badge bg-label-primary">{{ $role->name }}</span>
                                @empty
                                    <span class="badge bg-label-secondary">No Role</span>
                                @endforelse
                            </td>
                            <td>
                                @if ($user->email_verified_at)
                                    <span class="badge bg-label-success">Aktif</span>
                                @else
                                    <span class="badge bg-label-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <x-access-control.action-buttons 
                                    :id="$user->id_user"
                                    modal-target="modalAddUser"
                                />
                            </td>
                        </tr>
                    @empty
                        <x-access-control.empty-state 
                            colspan="7" 
                            icon="ti-users-off" 
                            message="Tidak ada data user ditemukan" 
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <x-access-control.pagination :paginator="$this->users" />
    </div>

    {{-- Modal Add/Edit User --}}
    <x-access-control.modal id="modalAddUser" :title="$editMode ? 'Edit User' : 'Tambah User Baru'">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror"
                        id="name" 
                        wire:model="name" 
                        placeholder="Masukkan nama" 
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        id="email" 
                        wire:model="email" 
                        placeholder="Masukkan email" 
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password 
                        @unless($editMode)
                            <span class="text-danger">*</span>
                        @endunless
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        id="password" 
                        wire:model="password"
                        placeholder="{{ $editMode ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan password' }}" 
                    />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">
                        Role <span class="text-danger">*</span>
                    </label>
                    <select 
                        class="form-select @error('selectedRole') is-invalid @enderror" 
                        id="role"
                        wire:model="selectedRole"
                    >
                        <option value="">Pilih Role</option>
                        @foreach ($this->roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <x-access-control.modal-footer :edit-mode="$editMode" />
        </form>
    </x-access-control.modal>

    {{-- Modal Delete Confirmation --}}
    <x-access-control.delete-modal 
        id="modalDeleteUser" 
        entity="user" 
    />
</div>

@script
<script>
    // Modal event handlers
    $wire.on('closeModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalAddUser'))?.hide();
    });

    $wire.on('openDeleteModal', () => {
        new bootstrap.Modal(document.getElementById('modalDeleteUser')).show();
    });

    $wire.on('closeDeleteModal', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalDeleteUser'))?.hide();
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
