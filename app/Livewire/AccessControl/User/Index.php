<?php

namespace App\Livewire\AccessControl\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\{Title, Layout, Computed};
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Livewire\Traits\WithAccessControl;

#[Layout('layouts.app')]
#[Title('User Management')]
class Index extends Component
{
    use WithPagination, WithAccessControl;

    /*
    |--------------------------------------------------------------------------
    | Form Properties
    |--------------------------------------------------------------------------
    */
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $selectedRole = '';
    public ?string $userId = null;

    /*
    |--------------------------------------------------------------------------
    | Validation Rules & Messages
    |--------------------------------------------------------------------------
    */
    protected function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$this->userId},id_user"],
            'selectedRole' => ['required', 'string', 'exists:roles,name'],
        ];

        // Password required hanya untuk create, optional untuk update
        $rules['password'] = $this->editMode 
            ? ['nullable', 'string', 'min:8'] 
            : ['required', 'string', 'min:8'];

        return $rules;
    }

    protected array $messages = [
        'name.required' => 'Nama wajib diisi.',
        'name.max' => 'Nama maksimal 255 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'selectedRole.required' => 'Role wajib dipilih.',
        'selectedRole.exists' => 'Role tidak valid.',
    ];

    /*
    |--------------------------------------------------------------------------
    | Computed Properties
    |--------------------------------------------------------------------------
    */
    #[Computed]
    public function users()
    {
        return User::query()
            ->with('roles')
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function roles()
    {
        return Role::query()
            ->orderBy('name')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD Operations
    |--------------------------------------------------------------------------
    */
    public function edit(string $id): void
    {
        $this->resetForm();
        
        $user = User::with('roles')->findOrFail($id);
        
        $this->editMode = true;
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->first()?->name ?? '';
    }

    public function save(): void
    {
        $this->validate();

        if ($this->editMode) {
            $this->updateUser();
        } else {
            $this->createUser();
        }

        $this->resetForm();
        $this->closeFormModal();
    }

    public function confirmDelete(): void
    {
        if (empty($this->deleteId)) {
            $this->toastError('ID user tidak valid.');
            $this->closeDeleteModal();
            return;
        }

        $user = User::find($this->deleteId);
        
        if (!$user) {
            $this->toastError('User tidak ditemukan.');
            $this->closeDeleteModal();
            return;
        }

        if ($this->isDeletingSelf($user)) {
            $this->toastError('Anda tidak dapat menghapus akun Anda sendiri.');
            $this->closeDeleteModal();
            return;
        }

        // Remove all roles before deleting
        $user->syncRoles([]);
        
        $user->delete();
        
        $this->toastSuccess($this->getSuccessMessage('delete', 'User'));
        $this->closeDeleteModal();
    }

    /*
    |--------------------------------------------------------------------------
    | Private Methods
    |--------------------------------------------------------------------------
    */
    private function createUser(): void
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->selectedRole);
        
        $this->toastSuccess($this->getSuccessMessage('create', 'User'));
    }

    private function updateUser(): void
    {
        $user = User::findOrFail($this->userId);
        
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Update password hanya jika diisi
        if (filled($this->password)) {
            $user->update(['password' => Hash::make($this->password)]);
        }

        $user->syncRoles([$this->selectedRole]);
        
        $this->toastSuccess($this->getSuccessMessage('update', 'User'));
    }

    private function isDeletingSelf(User $user): bool
    {
        return $user->id_user === Auth::user()->id_user;
    }

    /*
    |--------------------------------------------------------------------------
    | Trait Implementation
    |--------------------------------------------------------------------------
    */
    protected function getFormFields(): array
    {
        return ['name', 'email', 'password', 'selectedRole', 'userId'];
    }

    protected function getFormData(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->selectedRole,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.access-control.user.index');
    }
}
