<?php

namespace App\Services\MasterData;

use App\Models\KolConfiguration;
use App\Services\BaseService;

/**
 * Service untuk mengelola data KOL Configuration
 */
class KolConfigurationService extends BaseService
{
    protected string $model = KolConfiguration::class;

    /**
     * Get all records ordered by KOL
     */
    public function getAllOrdered()
    {
        return $this->query()->orderBy('kol')->get();
    }

    /**
     * Get KOL by kol value
     */
    public function findByKol(string $kol): ?KolConfiguration
    {
        return $this->query()->where('kol', $kol)->first();
    }

    /**
     * Get KOL berdasarkan jumlah hari keterlambatan
     */
    public function getKolByHariKeterlambatan(int $hari): ?KolConfiguration
    {
        return $this->query()
            ->where('jumlah_hari_keterlambatan', '>=', $hari)
            ->orderBy('jumlah_hari_keterlambatan')
            ->first();
    }

    /**
     * Get presentase pencairan berdasarkan KOL
     */
    public function getPresentasePencairanByKol(string $kol): ?float
    {
        $record = $this->findByKol($kol);
        return $record ? $record->presentase_pencairan : null;
    }
}
