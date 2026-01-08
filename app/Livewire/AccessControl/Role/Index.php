<?php

namespace App\Livewire\AccessControl\Role;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\{Title, Layout, Computed};
use Spatie\Permission\Models\{Role, Permission};
use App\Livewire\Traits\WithAccessControl;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Role Management')]
class Index extends Component
{
    use WithPagination, WithAccessControl;

    /*
    |--------------------------------------------------------------------------
    | Form Properties
    |--------------------------------------------------------------------------
    */
    public string $name = '';
    public array $selectedPermissions = [];
    public ?int $roleId = null;

    /*
    |--------------------------------------------------------------------------
    | Validation Rules & Messages
    |--------------------------------------------------------------------------
    */
    protected function rules(): array
    {
        $uniqueRule = $this->editMode 
            ? "unique:roles,name,{$this->roleId}" 
            : 'unique:roles,name';

        return [
            'name' => ['required', 'string', 'max:255', $uniqueRule],
            'selectedPermissions' => ['array'],
            'selectedPermissions.*' => ['string', 'exists:permissions,name'],
        ];
    }

    protected array $messages = [
        'name.required' => 'Nama role wajib diisi.',
        'name.unique' => 'Nama role sudah digunakan.',
        'name.max' => 'Nama role maksimal 255 karakter.',
    ];

    /*
    |--------------------------------------------------------------------------
    | Computed Properties
    |--------------------------------------------------------------------------
    */
    #[Computed]
    public function roles()
    {
        // Get the morph key from permission config
        $morphKey = config('permission.column_names.model_morph_key', 'model_id');
        
        return Role::query()
            ->with('permissions')
            ->addSelect([
                'users_count' => DB::table('model_has_roles')
                    ->selectRaw('count(*)')
                    ->whereColumn('model_has_roles.role_id', 'roles.id')
                    ->where('model_type', User::class)
            ])
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function permissions()
    {
        return Permission::query()
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function groupedPermissions()
    {
        return $this->permissions->groupBy(
            fn($permission) => explode('.', $permission->name)[0] ?? 'other'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD Operations
    |--------------------------------------------------------------------------
    */
    public function edit(int $id): void
    {
        $this->resetForm();
        
        $role = Role::with('permissions')->findOrFail($id);
        
        $this->editMode = true;
        $this->roleId = $id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    }

    public function save(): void
    {
        $this->validate();

        if ($this->editMode) {
            $this->updateRole();
        } else {
            $this->createRole();
        }

        $this->resetForm();
        $this->closeFormModal();
    }

    public function confirmDelete(): void
    {
        if (empty($this->deleteId)) {
            $this->toastError('ID role tidak valid.');
            $this->closeDeleteModal();
            return;
        }

        $role = Role::find($this->deleteId);
        
        if (!$role) {
            $this->toastError('Role tidak ditemukan.');
            $this->closeDeleteModal();
            return;
        }

        if ($this->hasAssignedUsers($role)) {
            $this->toastError('Role tidak dapat dihapus karena masih digunakan oleh user.');
            $this->closeDeleteModal();
            return;
        }

        // Detach all permissions first to avoid relationship issues
        $role->permissions()->detach();
        
        $role->delete();
        
        $this->toastSuccess($this->getSuccessMessage('delete', 'Role'));
        $this->closeDeleteModal();
    }

    /*
    |--------------------------------------------------------------------------
    | Private Methods
    |--------------------------------------------------------------------------
    */
    private function createRole(): void
    {
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);
        
        $this->toastSuccess($this->getSuccessMessage('create', 'Role'));
    }

    private function updateRole(): void
    {
        $role = Role::findOrFail($this->roleId);
        $role->update(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);
        
        $this->toastSuccess($this->getSuccessMessage('update', 'Role'));
    }

    private function hasAssignedUsers(Role $role): bool
    {
        return DB::table('model_has_roles')
            ->where('role_id', $role->id)
            ->where('model_type', User::class)
            ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Trait Implementation
    |--------------------------------------------------------------------------
    */
    protected function getFormFields(): array
    {
        return ['name', 'selectedPermissions', 'roleId'];
    }

    protected function getFormData(): array
    {
        return [
            'name' => $this->name,
            'permissions' => $this->selectedPermissions,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.access-control.role.index');
    }
}
