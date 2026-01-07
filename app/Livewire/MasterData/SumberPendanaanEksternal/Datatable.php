<?php

namespace App\Livewire\MasterData\SumberPendanaanEksternal;

use App\Models\SumberPembiayaanEksternal;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Datatable extends DataTableComponent
{
    protected $model = SumberPembiayaanEksternal::class;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    private int $rowNumber = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id_sumber_pembiayaan');
        $this->setDefaultSort('created_at', 'desc');

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
                ->label(fn($row) => $this->getRowNumber())
                ->html()
                ->excludeFromColumnSelect(),

            Column::make('Nama Instansi', 'nama_instansi')
                ->sortable()
                ->searchable()
                ->format(fn($value) => '<span class="fw-medium">' . e($value) . '</span>')
                ->html(),

            Column::make('Presentase Bagi Hasil', 'presentase_bagi_hasil')
                ->sortable()
                ->searchable()
                ->format(fn($value) => '<span class="badge bg-label-primary">' . number_format($value, 2) . '%</span>')
                ->html(),

            Column::make('Aksi', 'id_sumber_pembiayaan')
                ->format(function ($value) {
                    return view('livewire.master-data.sumber-pendanaan.action-buttons', [
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
        return '<span class="text-muted">' . $number . '</span>';
    }
}
