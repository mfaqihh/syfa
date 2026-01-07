<?php

namespace App\Livewire\MasterData\CellsProject;

use App\Models\CellsProject;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Datatable extends DataTableComponent
{
    protected $model = CellsProject::class;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    private int $rowNumber = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id_cells_project');

        $this->setTableWrapperAttributes([
            'class' => 'table-responsive',
        ]);
        $this->setTableAttributes([
            'class' => 'table table-hover',
        ]);

        // Pagination
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(10);

        $this->setSearchEnabled();
        $this->setSearchDebounce(300);
        $this->setSearchPlaceholder('Cari data...');

        $this->setColumnSelectDisabled();
        $this->setSortingPillsDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make('No')
                ->label(fn ($row) => $this->getRowNumber())
                ->html()
                ->excludeFromColumnSelect(),
            Column::make('Nama cells project', 'nama_cells_project')
                ->sortable()
                ->searchable(),
            Column::make('Nama pic', 'nama_pic')
                ->sortable()
                ->searchable(),
            Column::make('Tanda tangan pic', 'tanda_tangan_pic')
                ->label(function ($row) {
                    if ($row->tanda_tangan_pic) {
                        $url = asset('storage/'.$row->tanda_tangan_pic);

                        return '<a href="'.$url.'" target="_blank" class="btn btn-sm btn-icon btn-primary" title="Lihat Tanda Tangan">
                                    <i class="ti ti-file-signature"></i>
                                </a>';
                    }

                    return '<span class="text-muted">-</span>';
                })
                ->html(),
            Column::make('Alamat', 'alamat')
                ->sortable(),
            Column::make('Deskripsi bidang', 'deskripsi_bidang')
                ->sortable(),
            Column::make('Aksi', 'id_cells_project')
                ->format(function ($value) {
                    return view('livewire.master-data.cells-project.action-buttons', [
                        'id' => $value,
                    ]);
                })
                ->html()
                ->excludeFromColumnSelect(),
        ];
    }

    private function getRowNumber(): string
    {
        $this->rowNumber++;
        $number = (($this->getPage() - 1) * $this->getPerPage()) + $this->rowNumber;

        return '<span class="text-muted">'.$number.'</span>';
    }
}
