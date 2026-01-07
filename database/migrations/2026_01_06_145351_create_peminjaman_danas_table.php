<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_dana', function (Blueprint $table) {
            $table->ulid('id_peminjaman_dana')->primary();
            $table->string('nomor_peminjaman', 50)->unique();
            $table->foreignUlid('id_user')->constrained('users', 'id_user');
            $table->string('sumber_pembiayaan');
            $table->foreignUlid('id_sumber_pembiayaan')->constrained('sumber_pembiayaan_eksternal', 'id_sumber_pembiayaan');
            $table->string('nama_rekening');
            $table->string('nomor_rekening');
            $table->string('lampiran_sid');
            $table->string('tujuan_peminjaman');
            $table->string('jenis_pembiayaan');
            $table->decimal('total_peminjaman', 15, 2);
            $table->decimal('total_bagi_hasil', 15, 2);
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_jatuh_tempo');
            $table->integer('jumlah_cicilan')->nullable();
            $table->decimal('total_jumlah_peminjaman', 15, 2);
            $table->decimal('total_dibayarkan', 15, 2)->default(0);
            $table->decimal('presentase_bagi_hasil', 10, 2);
            $table->string('status_peminjaman')->default('draft');
            $table->boolean('is_active')->default(true);
            $table->string('bukti_transfer')->nullable();
            $table->string('nomor_kontrak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_dana');
    }
};
