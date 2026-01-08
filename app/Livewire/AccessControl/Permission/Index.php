<?php

namespace App\Livewire\AccessControl\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\{Title, Layout, Computed};
use Spatie\Permission\Models\Permission;
use App\Livewire\Traits\WithAccessControl;

#[Layout('layouts.app')]
#[Title('Permission Management')]
class Index extends Component
{
    use WithPagination, WithAccessControl;

    /*
    |--------------------------------------------------------------------------
    | Form Properties
    |--------------------------------------------------------------------------
    */
    public string $name = '';
    public ?int $permissionId = null;

    /*
    |--------------------------------------------------------------------------
    | Validation Rules & Messages
    |--------------------------------------------------------------------------
    */
    protected function rules(): array
    {
        $uniqueRule = $this->editMode 
            ? "unique:permissions,name,{$this->permissionId}" 
            : 'unique:permissions,name';

        return [
            'name' => ['required', 'string', 'max:255', $uniqueRule],
        ];
    }

    protected array $messages = [
        'name.required' => 'Nama permission wajib diisi.',
        'name.unique' => 'Nama permission sudah digunakan.',
        'name.max' => 'Nama permission maksimal 255 karakter.',
    ];

    /*
    |--------------------------------------------------------------------------
    | Computed Properties
    |--------------------------------------------------------------------------
    */
    #[Computed]
    public function permissions()
    {
        return Permission::query()
            ->with('roles')
            ->withCount('roles')
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->paginate(15);
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD Operations
    |--------------------------------------------------------------------------
    */
    public function edit(int $id): void
    {
        $this->resetForm();
        
        $permission = Permission::findOrFail($id);
        
        $this->editMode = true;
        $this->permissionId = $id;
        $this->name = $permission->name;
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->getFormData();

        if ($this->editMode) {
            $this->updatePermission($data);
        } else {
            $this->createPermission($data);
        }

        $this->resetForm();
        $this->closeFormModal();
    }

    public function confirmDelete(): void
    {
        if (empty($this->deleteId)) {
            $this->toastError('ID permission tidak valid.');
            $this->closeDeleteModal();
            return;
        }

        $permission = Permission::find($this->deleteId);
        
        if (!$permission) {
            $this->toastError('Permission tidak ditemukan.');
            $this->closeDeleteModal();
            return;
        }

        if ($this->hasAssignedRoles($permission)) {
            $this->toastError('Permission tidak dapat dihapus karena masih digunakan oleh role.');
            $this->closeDeleteModal();
            return;
        }

        $permission->delete();
        
        $this->toastSuccess($this->getSuccessMessage('delete', 'Permission'));
        $this->closeDeleteModal();
    }

    /*
    |--------------------------------------------------------------------------
    | Private Methods
    |--------------------------------------------------------------------------
    */
    private function createPermission(array $data): void
    {
        Permission::create($data);
        $this->toastSuccess($this->getSuccessMessage('create', 'Permission'));
    }

    private function updatePermission(array $data): void
    {
        $permission = Permission::findOrFail($this->permissionId);
        $permission->update($data);
        $this->toastSuccess($this->getSuccessMessage('update', 'Permission'));
    }

    private function hasAssignedRoles(Permission $permission): bool
    {
        return $permission->roles()->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Trait Implementation
    |--------------------------------------------------------------------------
    */
    protected function getFormFields(): array
    {
        return ['name', 'permissionId'];
    }

    protected function getFormData(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.access-control.permission.index');
    }
}
