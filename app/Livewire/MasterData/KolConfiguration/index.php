<?php

namespace App\Livewire\MasterData\KolConfiguration;

use App\Http\Requests\MasterData\KolConfigurationRequest;
use App\Livewire\Traits\WithCrudActions;
use App\Services\MasterData\KolConfigurationService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('KOL Configuration')]
class Index extends Component
{
    use WithCrudActions, WithFileUploads;

    // Form fields
    public string $kol = '';
    public $presentase_pencairan = '';
    public $jumlah_hari_keterlambatan = '';

    // Service instance
    protected KolConfigurationService $service;

    /**
     * Boot method - inject service
     */
    public function boot(KolConfigurationService $service): void
    {
        $this->service = $service;
    }

    /**
     * Dynamic validation rules dari Form Request
     */
    public function rules(): array
    {
        return KolConfigurationRequest::livewireRules($this->editId);
    }

    /**
     * Validation attributes dari Form Request
     */
    public function validationAttributes(): array
    {
        return KolConfigurationRequest::livewireAttributes();
    }

    /**
     * Define form fields for reset
     */
    protected function getFormFields(): array
    {
        return ['kol', 'presentase_pencairan', 'jumlah_hari_keterlambatan'];
    }

    /**
     * Get data from form for create/update
     */
    protected function getFormData(): array
    {
        return [
            'kol' => $this->kol,
            'presentase_pencairan' => $this->presentase_pencairan,
            'jumlah_hari_keterlambatan' => $this->jumlah_hari_keterlambatan,
        ];
    }

    /**
     * Fill form with record data for editing
     */
    protected function fillFormData($record): void
    {
        $this->kol = $record->kol;
        $this->presentase_pencairan = $record->presentase_pencairan;
        $this->jumlah_hari_keterlambatan = $record->jumlah_hari_keterlambatan;
    }

    /**
     * Custom success messages
     */
    protected function getCreateSuccessMessage(): string
    {
        return 'Konfigurasi KOL berhasil ditambahkan!';
    }

    protected function getUpdateSuccessMessage(): string
    {
        return 'Konfigurasi KOL berhasil diperbarui!';
    }

    protected function getDeleteSuccessMessage(): string
    {
        return 'Konfigurasi KOL berhasil dihapus!';
    }

    public function render()
    {
        return view('livewire.master-data.kol-configuration.index');
    }
}
