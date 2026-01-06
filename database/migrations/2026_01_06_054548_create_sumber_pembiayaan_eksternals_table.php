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
        Schema::create('sumber_pembiayaan_eksternal', function (Blueprint $table) {
            $table->ulid('id_sumber_pembiayaan')->primary();
            $table->string('nama_instansi');
            $table->decimal('presentase_bagi_hasil', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_pembiayaan_eksternal');
    }
};
