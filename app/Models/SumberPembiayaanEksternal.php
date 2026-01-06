<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberPembiayaanEksternal extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'sumber_pembiayaan_eksternal';
    protected $primaryKey = 'id_sumber_pembiayaan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_instansi',
        'presentase_bagi_hasil',
    ];
}
