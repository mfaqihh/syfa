<?php

namespace App\Livewire\Traits;

/**
 * Trait untuk komponen Access Control
 * Menyediakan fungsi-fungsi umum untuk CRUD operasi sederhana
 * 
 * Required properties di component:
 * - $search: string
 * - $editMode: bool
 * - $deleteId: mixed
 * 
 * Required methods di component:
 * - getModel(): string (return model class name)
 * - getFormFields(): array (return array of form field names)
 * - fillForm($record): void (mengisi form dengan data record)
 * - getFormData(): array (return array data untuk save)
 * - getDeleteModalName(): string (return modal element id)
 * - getFormModalName(): string (return modal element id)
 */
trait WithAccessControl
{
    use WithModal, WithToast;

    public string $search = '';
    public bool $editMode = false;
    public mixed $deleteId = null;

    protected string $paginationTheme = 'bootstrap';

    /**
     * Reset pagination saat search berubah
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset semua form field ke default
     */
    public function resetForm(): void
    {
        $this->reset($this->getFormFields());
        $this->editMode = false;
        $this->resetValidation();
    }

    /**
     * Konfirmasi hapus - menampilkan modal
     */
    public function deleteConfirm(mixed $id): void
    {
        $this->deleteId = $id;
        $this->dispatch('openDeleteModal');
    }

    /**
     * Tutup modal form
     */
    protected function closeFormModal(): void
    {
        $this->dispatch('closeModal');
    }

    /**
     * Tutup modal delete
     */
    protected function closeDeleteModal(): void
    {
        $this->dispatch('closeDeleteModal');
        $this->deleteId = null;
    }

    /**
     * Get form fields - harus di-implement oleh component
     */
    abstract protected function getFormFields(): array;

    /**
     * Get form data untuk create/update - harus di-implement oleh component
     */
    abstract protected function getFormData(): array;

    /**
     * Get success message untuk operasi tertentu
     */
    protected function getSuccessMessage(string $action, string $entity): string
    {
        $actions = [
            'create' => 'ditambahkan',
            'update' => 'diperbarui',
            'delete' => 'dihapus',
        ];

        return "{$entity} berhasil {$actions[$action]}.";
    }

    /**
     * Get error message
     */
    protected function getErrorMessage(string $message): string
    {
        return $message;
    }
}
