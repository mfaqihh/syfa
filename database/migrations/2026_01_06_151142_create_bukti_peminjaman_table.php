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
        Schema::create('bukti_peminjaman', function (Blueprint $table) {
            $table->ulid('id_bukti_peminjaman')->primary();
            $table->foreignUlid('id_peminjaman_dana')->constrained('peminjaman_dana', 'id_peminjaman_dana')->onDelete('cascade');
            $table->string('nomor_bukti')->unique();
            $table->string('nama_client')->nullable();
            $table->string('nama_barang')->nullable();
            $table->decimal('nilai_invoice', 15, 2);
            $table->decimal('nilai_peminjaman', 15, 2);
            $table->date('tanggal_bukti')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->string('dokumen_bukti')->nullable();
            $table->string('dokumen_so')->nullable();
            $table->string('dokumen_bast')->nullable();
            $table->string('dokumen_lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_peminjaman');
    }
};
