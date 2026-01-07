<?php

namespace App\Services\MasterData;

use App\Models\CellsProject;
use App\Services\BaseService;

class CellsProjectService extends BaseService
{
    protected string $model = CellsProject::class;

    public function getAllOrdered()
    {
        return $this->query()->orderBy('nama_cells_project')->get();
    }

    public function findByName(string $name): ?CellsProject
    {
        return $this->query()->where('nama_cells_project', $name)->first();
    }

    public function searchByPic(string $picName)
    {
        return $this->query()
            ->where('nama_pic', 'like', "%{$picName}%")
            ->get();
    }

}
