<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPeminjaman extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'bukti_peminjaman';
    protected $primaryKey = 'id_bukti_peminjaman';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_peminjaman_dana',
        'nomor_jaminan',
        'nama_client',
        'nama_barang',
        'nilai_jaminan',
        'nilai_peminjaman',
        'tanggal_jaminan',
        'tanggal_jatuh_tempo',
        'dokumen_invoice',
        'dokumen_kontrak',
        'dokumen_so',
        'dokumen_bast',
        'dokumen_lainnya',
    ];
}
