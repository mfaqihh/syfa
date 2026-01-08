<?php

namespace App\Livewire\AccessControl\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Role Management')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $selectedPermissions = [];
    public $roleId = null;
    public $deleteId = null;
    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255|unique:roles,name',
        'selectedPermissions' => 'array',
    ];

    protected $messages = [
        'name.required' => 'Nama role wajib diisi.',
        'name.unique' => 'Nama role sudah digunakan.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['name', 'selectedPermissions', 'roleId', 'editMode']);
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->editMode = true;
        $this->roleId = $id;

        $role = Role::findOrFail($id);
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->editMode) {
            $rules['name'] = 'required|string|max:255|unique:roles,name,' . $this->roleId;
        }
        $this->validate($rules);

        if ($this->editMode) {
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);

            session()->flash('success', 'Role berhasil diperbarui.');
        } else {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);

            session()->flash('success', 'Role berhasil ditambahkan.');
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
        $role = Role::findOrFail($this->deleteId);

        // Check if role has users
        if ($role->users()->count() > 0) {
            session()->flash('error', 'Role tidak dapat dihapus karena masih digunakan oleh user.');
            $this->dispatch('closeDeleteModal');
            return;
        }

        $role->delete();

        session()->flash('success', 'Role berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->deleteId = null;
    }

    public function render()
    {
        $roles = Role::with('permissions')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('users')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $permissions = Permission::orderBy('name')->get();

        return view('livewire.access-control.role.index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }
}
