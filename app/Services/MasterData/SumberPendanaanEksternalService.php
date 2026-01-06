<?php

namespace App\Services\MasterData;

use App\Models\SumberPembiayaanEksternal;
use App\Services\BaseService;

/**
 * Service untuk mengelola data Sumber Pendanaan Eksternal
 */
class SumberPendanaanEksternalService extends BaseService
{
    protected string $model = SumberPembiayaanEksternal::class;

    /**
     * Get all records ordered by nama_instansi
     */
    public function getAllOrdered()
    {
        return $this->query()->orderBy('nama_instansi')->get();
    }

    /**
     * Search by nama instansi
     */
    public function searchByNamaInstansi(string $keyword)
    {
        return $this->query()
            ->where('nama_instansi', 'like', "%{$keyword}%")
            ->get();
    }

    /**
     * Get total presentase bagi hasil
     */
    public function getTotalPresentase(): float
    {
        return $this->query()->sum('presentase_bagi_hasil');
    }
}
