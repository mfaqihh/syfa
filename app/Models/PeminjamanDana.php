<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDana extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'peminjaman_dana';
    protected $primaryKey = 'id_peminjaman_dana';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_peminjaman',
        'id_user',
        'sumber_pembiayaan',
        'id_sumber_pembiayaan',
        'nama_rekening',
        'nomor_rekening',
        'lampiran_sid',
        'tujuan_peminjaman',
        'jenis_pembiayaan',
        'total_peminjaman',
        'total_bagi_hasil',
        'tanggal_peminjaman',
        'tanggal_jatuh_tempo',
        'jumlah_cicilan',
        'total_jumlah_peminjaman',
        'total_dibayarkan',
        'presentase_bagi_hasil',
        'status_peminjaman',
        'is_active',
        'bukti_transfer',
        'nomor_kontrak',
    ];
}
