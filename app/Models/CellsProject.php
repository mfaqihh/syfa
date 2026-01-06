<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellsProject extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'cells_project';
    protected $primaryKey = 'id_cells_project';
    public  $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'nama_cells_project',
        'nama_pic',
        'tanda_tangan_pic',
        'alamat',
        'deskripsi_bidang',
    ];
}
