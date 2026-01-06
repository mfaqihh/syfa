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
        Schema::create('kol_configuration', function (Blueprint $table) {
            $table->ulid('id_kol')->primary();
            $table->integer('kol')->default(0);
            $table->decimal('presentase_pencairan', 5, 2);
            $table->integer('jumlah_hari_keterlambatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kol_configuration');
    }
};
