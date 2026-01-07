<?php

namespace App\Livewire\PeminjamanDana;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PeminjamanDana;

class Datatable extends DataTableComponent
{
    protected $model = PeminjamanDana::class;
    protected $listeners = ['refreshDatatable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id_peminjaman_dana');
    }

    public function columns(): array
    {
        return [
            Column::make("Nomor peminjaman", "nomor_peminjaman")
                ->sortable(),
            Column::make("Jenis pembiayaan", "jenis_pembiayaan")
                ->sortable(),
            Column::make("Total peminjaman", "total_peminjaman")
                ->sortable(),
            Column::make("Total bagi hasil", "total_bagi_hasil")
                ->sortable(),
            Column::make("Tanggal peminjaman", "tanggal_peminjaman")
                ->sortable(),
            Column::make("Tanggal jatuh tempo", "tanggal_jatuh_tempo")
                ->sortable(),
            Column::make("Total jumlah peminjaman", "total_jumlah_peminjaman")
                ->sortable(),
            Column::make("Total dibayarkan", "total_dibayarkan")
                ->sortable(),
            Column::make("Status peminjaman", "status_peminjaman")
                ->sortable(),
            Column::make("Is active", "is_active")
                ->sortable(),
        ];
    }
}
