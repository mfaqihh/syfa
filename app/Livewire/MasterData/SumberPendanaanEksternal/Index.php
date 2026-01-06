<?php

namespace App\Livewire\MasterData\SumberPendanaanEksternal;

use App\Http\Requests\MasterData\SumberPendanaanEksternalRequest;
use App\Livewire\Traits\WithCrudActions;
use App\Services\MasterData\SumberPendanaanEksternalService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Sumber Pendanaan Eksternal')]
class Index extends Component
{
    use WithCrudActions, WithFileUploads;

    // Form fields
    public string $nama_instansi = '';
    public $presentase_bagi_hasil = '';

    // Service instance
    protected SumberPendanaanEksternalService $service;

    /**
     * Boot method - inject service
     */
    public function boot(SumberPendanaanEksternalService $service): void
    {
        $this->service = $service;
    }

    /**
     * Dynamic validation rules dari Form Request
     */
    public function rules(): array
    {
        return SumberPendanaanEksternalRequest::livewireRules($this->editId);
    }

    /**
     * Validation attributes dari Form Request
     */
    public function validationAttributes(): array
    {
        return SumberPendanaanEksternalRequest::livewireAttributes();
    }

    /**
     * Define form fields for reset
     */
    protected function getFormFields(): array
    {
        return ['nama_instansi', 'presentase_bagi_hasil'];
    }

    /**
     * Get data from form for create/update
     */
    protected function getFormData(): array
    {
        return [
            'nama_instansi' => $this->nama_instansi,
            'presentase_bagi_hasil' => $this->presentase_bagi_hasil,
        ];
    }

    /**
     * Fill form with record data for editing
     */
    protected function fillFormData($record): void
    {
        $this->nama_instansi = $record->nama_instansi;
        $this->presentase_bagi_hasil = $record->presentase_bagi_hasil;
    }

    /**
     * Custom success messages
     */
    protected function getCreateSuccessMessage(): string
    {
        return 'Sumber pendanaan eksternal berhasil ditambahkan!';
    }

    protected function getUpdateSuccessMessage(): string
    {
        return 'Sumber pendanaan eksternal berhasil diperbarui!';
    }

    protected function getDeleteSuccessMessage(): string
    {
        return 'Sumber pendanaan eksternal berhasil dihapus!';
    }

    public function render()
    {
        return view('livewire.master-data.sumber-pendanaan.index');
    }
}
