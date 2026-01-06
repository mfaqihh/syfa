<?php

namespace App\Livewire\Traits;

/**
 * Trait untuk menampilkan toast notifications
 * Digunakan oleh Livewire components untuk mengirim notifikasi ke frontend
 */
trait WithToast
{
    /**
     * Menampilkan toast success
     */
    public function toastSuccess(string $message): void
    {
        $this->dispatch('toast', type: 'success', message: $message);
    }

    /**
     * Menampilkan toast error
     */
    public function toastError(string $message): void
    {
        $this->dispatch('toast', type: 'danger', message: $message);
    }

    /**
     * Menampilkan toast warning
     */
    public function toastWarning(string $message): void
    {
        $this->dispatch('toast', type: 'warning', message: $message);
    }

    /**
     * Menampilkan toast info
     */
    public function toastInfo(string $message): void
    {
        $this->dispatch('toast', type: 'info', message: $message);
    }
}
