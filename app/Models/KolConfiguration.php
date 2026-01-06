<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KolConfiguration extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'kol_configuration';
    protected $primaryKey = 'id_kol';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kol',
        'presentase_pencairan',
        'jumlah_hari_keterlambatan',
    ];
}
