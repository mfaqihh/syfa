<?php

namespace App\Livewire\AccessControl\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Permission Management')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $permissionId = null;
    public $deleteId = null;
    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255|unique:permissions,name',
    ];

    protected $messages = [
        'name.required' => 'Nama permission wajib diisi.',
        'name.unique' => 'Nama permission sudah digunakan.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['name', 'permissionId', 'editMode']);
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->editMode = true;
        $this->permissionId = $id;

        $permission = Permission::findOrFail($id);
        $this->name = $permission->name;
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->editMode) {
            $rules['name'] = 'required|string|max:255|unique:permissions,name,' . $this->permissionId;
        }
        $this->validate($rules);

        if ($this->editMode) {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update(['name' => $this->name]);

            session()->flash('success', 'Permission berhasil diperbarui.');
        } else {
            Permission::create(['name' => $this->name]);

            session()->flash('success', 'Permission berhasil ditambahkan.');
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
        $permission = Permission::findOrFail($this->deleteId);

        // Check if permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            session()->flash('error', 'Permission tidak dapat dihapus karena masih digunakan oleh role.');
            $this->dispatch('closeDeleteModal');
            return;
        }

        $permission->delete();

        session()->flash('success', 'Permission berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->deleteId = null;
    }

    public function render()
    {
        $permissions = Permission::with('roles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('roles')
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.access-control.permission.index', [
            'permissions' => $permissions,
        ]);
    }
}
