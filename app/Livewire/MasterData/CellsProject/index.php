<?php

namespace App\Livewire\MasterData\CellsProject;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Livewire\Traits\WithCrudActions;
use App\Services\MasterData\CellsProjectService;
use App\Http\Requests\MasterData\CellsProjectRequest;

#[Layout('layouts.app')]
#[Title('Cells Project')]
class Index extends Component
{
    use WithCrudActions, WithFileUploads;
    
    public string $nama_cells_project = '';
    public string $nama_pic = '';
    public $tanda_tangan_pic;
    public string $alamat = '';
    public string $deskripsi_bidang = '';

    protected CellsProjectService $service;

    public function boot(CellsProjectService $service): void
    {
        $this->service = $service;
    }

    public function rules(): array
    {
        return CellsProjectRequest::livewireRules($this->editId);
    }

    public function getFormFields(): array
    {
        return [
            'nama_cells_project',
            'nama_pic',
            'tanda_tangan_pic',
            'alamat',
            'deskripsi_bidang',
        ];
    }

    public function getFormData(): array
    {
        $data = [
            'nama_cells_project' => $this->nama_cells_project,
            'nama_pic' => $this->nama_pic,
            'alamat' => $this->alamat,
            'deskripsi_bidang' => $this->deskripsi_bidang,
        ];

        if ($this->tanda_tangan_pic) {
            $path = $this->tanda_tangan_pic->store('tanda_tangan_pics', 'public');
            $data['tanda_tangan_pic'] = $path;
        }

        return $data;
    }

    protected function fillFormData($record): void
    {
        $this->nama_cells_project = $record->nama_cells_project;
        $this->nama_pic = $record->nama_pic;
        $this->alamat = $record->alamat;
        $this->deskripsi_bidang = $record->deskripsi_bidang;
    }

    public function getCreateSuccessMessage(): string
    {
        return 'Cells Project berhasil ditambahkan.';
    }

    public function getUpdateSuccessMessage(): string
    {
        return 'Cells Project berhasil diupdate.';
    }

    public function getDeleteSuccessMessage(): string
    {
        return 'Cells Project berhasil dihapus.';
    }

    public function render()
    {
        return view('livewire.master-data.cells-project.index');
    }
}   