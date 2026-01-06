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
        Schema::create('cells_project', function (Blueprint $table) {
            $table->ulid('id_cells_project')->primary ();
            $table->string('nama_cells_project');
            $table->string('nama_pic');
            $table->string('tanda_tangan_pic');
            $table->string('alamat');
            $table->string('deskripsi_bidang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cells_project');
    }
};
