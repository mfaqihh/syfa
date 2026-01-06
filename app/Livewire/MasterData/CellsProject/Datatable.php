<?php

namespace App\Livewire\MasterData\CellsProject;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CellsProject;

class Datatable extends DataTableComponent
{
    protected $model = CellsProject::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_cells_project');
    }

    public function columns(): array
    {
        return [
            Column::make("Id cells project", "id_cells_project")
                ->sortable(),
            Column::make("Nama cells project", "nama_cells_project")
                ->sortable(),
            Column::make("Nama pic", "nama_pic")
                ->sortable(),
            Column::make("Tanda tangan pic", "tanda_tangan_pic")
                ->sortable(),
            Column::make("Alamat", "alamat")
                ->sortable(),
            Column::make("Deskripsi bidang", "deskripsi_bidang")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
