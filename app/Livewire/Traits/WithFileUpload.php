<?php

namespace App\Livewire\Traits;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Trait untuk menangani file upload di Livewire
 * Digunakan bersama dengan Livewire\WithFileUploads trait
 */
trait WithFileUpload
{
    /**
     * Default disk untuk upload
     */
    protected string $uploadDisk = 'public';

    /**
     * Upload single file dan return path
     */
    protected function uploadFile(
        TemporaryUploadedFile $file,
        string $folder = 'uploads',
        ?string $customName = null
    ): string {
        $filename = $customName ?? $this->generateFileName($file);

        return $file->storeAs($folder, $filename, $this->uploadDisk);
    }

    /**
     * Upload multiple files dan return array of paths
     */
    protected function uploadMultipleFiles(
        array $files,
        string $folder = 'uploads'
    ): array {
        $paths = [];

        foreach ($files as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $paths[] = $this->uploadFile($file, $folder);
            }
        }

        return $paths;
    }

    /**
     * Delete file dari storage
     */
    protected function deleteFile(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk($this->uploadDisk)->delete($path);
    }

    /**
     * Delete multiple files
     */
    protected function deleteMultipleFiles(array $paths): void
    {
        foreach ($paths as $path) {
            $this->deleteFile($path);
        }
    }

    /**
     * Replace file (delete old, upload new)
     */
    protected function replaceFile(
        ?string $oldPath,
        TemporaryUploadedFile $newFile,
        string $folder = 'uploads'
    ): string {
        // Delete old file if exists
        if ($oldPath) {
            $this->deleteFile($oldPath);
        }

        // Upload new file
        return $this->uploadFile($newFile, $folder);
    }

    /**
     * Generate unique filename
     */
    protected function generateFileName(TemporaryUploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('Ymd_His');
        $random = substr(md5(uniqid()), 0, 8);

        return "{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Get file URL from path
     */
    protected function getFileUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return Storage::disk($this->uploadDisk)->url($path);
    }

    /**
     * Check if file exists
     */
    protected function fileExists(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk($this->uploadDisk)->exists($path);
    }

    /**
     * Get allowed image mimes for validation
     */
    protected function getImageMimes(): string
    {
        return 'image/jpeg,image/png,image/gif,image/webp';
    }

    /**
     * Get allowed document mimes for validation
     */
    protected function getDocumentMimes(): string
    {
        return 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }

    /**
     * Get max file size in KB
     */
    protected function getMaxFileSize(): int
    {
        return 2048; // 2MB default
    }

    /**
     * Get max image size in KB
     */
    protected function getMaxImageSize(): int
    {
        return 5120; // 5MB default
    }
}
