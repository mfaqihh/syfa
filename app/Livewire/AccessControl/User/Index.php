<?php

namespace App\Livewire\AccessControl\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('User Management')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $selectedRole = '';
    public $userId = null;
    public $deleteId = null;
    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'selectedRole' => 'required|string|exists:roles,name',
        ];

        if (!$this->editMode) {
            $rules['password'] = 'required|string|min:8';
        } else {
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'selectedRole.required' => 'Role wajib dipilih.',
        'selectedRole.exists' => 'Role tidak valid.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'selectedRole', 'userId', 'editMode']);
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->editMode = true;
        $this->userId = $id;

        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->first()?->name ?? '';
    }

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if ($this->password) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            $user->syncRoles([$this->selectedRole]);

            session()->flash('success', 'User berhasil diperbarui.');
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            $user->assignRole($this->selectedRole);

            session()->flash('success', 'User berhasil ditambahkan.');
        }

        $this->resetForm();
        $this->dispatch('closeModal');
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function confirmDelete()
    {
        $user = User::findOrFail($this->deleteId);

        // Prevent deleting own account
        if ($user->id_user === \Illuminate\Support\Facades\Auth::user()->id_user) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            $this->dispatch('closeDeleteModal');
            return;
        }

        $user->delete();

        session()->flash('success', 'User berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->deleteId = null;
    }

    public function render()
    {
        $users = User::with('roles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $roles = Role::all();

        return view('livewire.access-control.user.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
