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
        // 'id_sumber_pembiayaan',
        'nama_rekening',
        'nomor_rekening',
        'lampiran_sid',
        'tujuan_peminjaman',
        'jenis_pembiayaan',
        'total_peminjaman',
        'total_bagi_hasil',
        'tanggal_pengajuan_peminjaman',
        'tanggal_jatuh_tempo',
        'tenor_peminjaman',
        'presentase_bagi_hasil',
        'pps',
        's_finance',
        'pembayaran_perbulan',
        'total_jumlah_peminjaman',
        'total_nominal_dialihkan',
        'total_peminjaman_disetujui', 
        'total_dibayarkan',
        'status_peminjaman',
        'is_active',
        'bukti_transfer',
        'nomor_kontrak',
    ];
}
