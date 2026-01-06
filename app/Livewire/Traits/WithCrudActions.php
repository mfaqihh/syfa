<?php

namespace App\Livewire\Traits;

use App\Services\BaseService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Trait untuk operasi CRUD universal
 * Digunakan oleh Livewire components untuk standardisasi CRUD operations
 * 
 * Required properties di component yang menggunakan trait ini:
 * - protected BaseService $service (service instance)
 * 
 * Required methods di component:
 * - getFormData(): array (return data dari form untuk create/update)
 * - fillFormData(Model $record): void (mengisi form dengan data dari record)
 * - getFormFields(): array (field names untuk reset)
 * 
 * Optional methods (bisa di-override):
 * - getValidationRules(): array (custom validation rules)
 * - getCreateSuccessMessage(): string
 * - getUpdateSuccessMessage(): string
 * - getDeleteSuccessMessage(): string
 * - beforeCreate(array &$data): void
 * - afterCreate($record): void
 * - beforeUpdate(string $id, array &$data): void
 * - afterUpdate($record): void
 * - beforeDelete(string $id): bool
 * - afterDelete(): void
 */
trait WithCrudActions
{
    use WithToast, WithModal, WithFileUpload;

    public bool $isEdit = false;
    public ?string $editId = null;
    public ?string $deleteId = null;

    /**
     * Reset form ke state awal
     */
    public function resetForm(): void
    {
        $this->reset($this->getFormFields());
        $this->reset(['isEdit', 'editId']);
        $this->resetValidation();
    }

    /**
     * Show delete confirmation modal
     */
    public function deleteConfirm(string $id): void
    {
        $this->deleteId = $id;
        $this->dispatch('openDeleteModal');
    }

    /**
     * Confirm and execute delete
     */
    public function confirmDelete(): void
    {
        if ($this->deleteId) {
            $this->delete($this->deleteId);
            $this->deleteId = null;
        }
    }

    /**
     * Menyimpan data (create atau update)
     */
    public function save(): void
    {
        $this->validate();

        try {
            $data = $this->getFormData();

            // Handle file uploads jika ada
            $data = $this->processFileUploads($data);

            if ($this->isEdit && $this->editId) {
                // Before update hook
                $this->beforeUpdate($this->editId, $data);

                $record = $this->service->update($this->editId, $data);

                // After update hook
                $this->afterUpdate($record);

                $this->toastSuccess($this->getUpdateSuccessMessage());
            } else {
                // Before create hook
                $this->beforeCreate($data);

                $record = $this->service->create($data);

                // After create hook
                $this->afterCreate($record);

                $this->toastSuccess($this->getCreateSuccessMessage());
            }

            $this->resetForm();
            $this->closeModal();
            $this->dispatch('refreshDatatable');
        } catch (\Exception $e) {
            $this->toastError('Terjadi kesalahan: ' . $e->getMessage());
            report($e); // Log the error
        }
    }

    /**
     * Mengisi form untuk edit
     */
    public function edit(string $id): void
    {
        try {
            $record = $this->service->find($id);

            if ($record) {
                $this->isEdit = true;
                $this->editId = $id;
                $this->fillFormData($record);
                $this->openModal();
            } else {
                $this->toastError('Data tidak ditemukan.');
            }
        } catch (\Exception $e) {
            $this->toastError('Gagal memuat data: ' . $e->getMessage());
            report($e);
        }
    }

    /**
     * Menghapus data
     */
    public function delete(string $id): void
    {
        try {
            // Before delete hook - can prevent deletion
            if (!$this->beforeDelete($id)) {
                return;
            }

            // Get record first for file cleanup
            $record = $this->service->find($id);

            // Delete files associated with record
            if ($record) {
                $this->cleanupFilesOnDelete($record);
            }

            $this->service->delete($id);

            // After delete hook
            $this->afterDelete();

            $this->toastSuccess($this->getDeleteSuccessMessage());
            $this->dispatch('refreshDatatable');
        } catch (\Exception $e) {
            $this->toastError('Gagal menghapus data: ' . $e->getMessage());
            report($e);
        }
    }

    /**
     * Process file uploads in form data
     * Override this method to handle specific file fields
     */
    protected function processFileUploads(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value instanceof TemporaryUploadedFile) {
                // Get folder from method if exists, otherwise use default
                $folder = method_exists($this, 'getUploadFolder')
                    ? $this->getUploadFolder()
                    : 'uploads';

                // If editing, get old file path to delete
                if ($this->isEdit && $this->editId) {
                    $oldRecord = $this->service->find($this->editId);
                    $oldPath = $oldRecord?->{$key} ?? null;
                    $data[$key] = $this->replaceFile($oldPath, $value, $folder);
                } else {
                    $data[$key] = $this->uploadFile($value, $folder);
                }
            }
        }

        return $data;
    }

    /**
     * Cleanup files when deleting a record
     * Override to specify which fields contain file paths
     */
    protected function cleanupFilesOnDelete($record): void
    {
        $fileFields = $this->getFileFields();

        foreach ($fileFields as $field) {
            if (!empty($record->{$field})) {
                $this->deleteFile($record->{$field});
            }
        }
    }

    /**
     * Get file fields for cleanup
     * Override this method to specify file fields
     */
    protected function getFileFields(): array
    {
        return [];
    }

    /**
     * Override di component untuk menentukan field form yang perlu di-reset
     */
    abstract protected function getFormFields(): array;

    /**
     * Override di component untuk mengambil data form
     */
    abstract protected function getFormData(): array;

    /**
     * Override di component untuk mengisi form dengan data record
     */
    abstract protected function fillFormData($record): void;

    /**
     * Hook sebelum create - bisa memodifikasi data
     */
    protected function beforeCreate(array &$data): void
    {
        // Override di component jika diperlukan
    }

    /**
     * Hook setelah create
     */
    protected function afterCreate($record): void
    {
        // Override di component jika diperlukan
    }

    /**
     * Hook sebelum update - bisa memodifikasi data
     */
    protected function beforeUpdate(string $id, array &$data): void
    {
        // Override di component jika diperlukan
    }

    /**
     * Hook setelah update
     */
    protected function afterUpdate($record): void
    {
        // Override di component jika diperlukan
    }

    /**
     * Hook sebelum delete - return false untuk membatalkan
     */
    protected function beforeDelete(string $id): bool
    {
        return true; // Override untuk custom logic
    }

    /**
     * Hook setelah delete
     */
    protected function afterDelete(): void
    {
        // Override di component jika diperlukan
    }

    /**
     * Pesan sukses saat create (bisa di-override)
     */
    protected function getCreateSuccessMessage(): string
    {
        return 'Data berhasil ditambahkan!';
    }

    /**
     * Pesan sukses saat update (bisa di-override)
     */
    protected function getUpdateSuccessMessage(): string
    {
        return 'Data berhasil diperbarui!';
    }

    /**
     * Pesan sukses saat delete (bisa di-override)
     */
    protected function getDeleteSuccessMessage(): string
    {
        return 'Data berhasil dihapus!';
    }
}
