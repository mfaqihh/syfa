<?php

namespace App\Livewire\Traits;

/**
 * Trait untuk mengelola Bootstrap modal
 * Digunakan oleh Livewire components untuk kontrol modal open/close
 */
trait WithModal
{
    /**
     * Membuka modal via JavaScript event
     */
    public function openModal(): void
    {
        $this->dispatch('openModal');
    }

    /**
     * Menutup modal via JavaScript event
     */
    public function closeModal(): void
    {
        $this->dispatch('closeModal');
    }

    /**
     * Membuka modal dengan ID tertentu
     */
    public function openModalById(string $modalId): void
    {
        $this->dispatch('openModalById', modalId: $modalId);
    }

    /**
     * Menutup modal dengan ID tertentu
     */
    public function closeModalById(string $modalId): void
    {
        $this->dispatch('closeModalById', modalId: $modalId);
    }
}
