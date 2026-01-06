<?php

namespace App\Livewire\MasterData\KolConfiguration;

use App\Models\KolConfiguration;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Datatable extends DataTableComponent
{
    protected $model = KolConfiguration::class;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    private int $rowNumber = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id_kol');
        $this->setDefaultSort('kol', 'asc');

        // Styling
        $this->setTableWrapperAttributes([
            'class' => 'table-responsive',
        ]);
        $this->setTableAttributes([
            'class' => 'table table-hover',
        ]);
        $this->setTheadAttributes([
            'class' => '',
        ]);

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

            Column::make('KOL', 'kol')
                ->sortable()
                ->searchable()
                ->format(fn($value) => '<span class="badge bg-label-info fw-bold">' . e($value) . '</span>')
                ->html(),

            Column::make('Presentase Pencairan', 'presentase_pencairan')
                ->sortable()
                ->searchable()

                ->format(fn($value) => '<span class="badge bg-label-success">' . number_format($value, 2) . '%</span>')
                ->html(),

            Column::make('Hari Keterlambatan', 'jumlah_hari_keterlambatan')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    $color = $value == 0 ? 'success' : ($value <= 30 ? 'warning' : 'danger');
                    return '<span class="badge bg-label-' . $color . '">' . $value . ' hari</span>';
                })
                ->html(),

            Column::make('Aksi', 'id_kol')
                ->format(function ($value) {
                    return view('livewire.master-data.kol-configuration.action-buttons', [
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
