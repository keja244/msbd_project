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
        Schema::create('prestasi_siswa', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('id', true);
            $table->integer('prestasi_id');
            $table->integer('siswa_id');

            $table->index('prestasi_id', 'prestasi_id');
            $table->index('siswa_id', 'siswa_id');

            $table->foreign('prestasi_id', 'prestasi_siswa_ibfk_1')->references('prestasi_id')->on('prestasi')->onDelete('cascade');
            $table->foreign('siswa_id', 'prestasi_siswa_ibfk_2')->references('siswa_id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswa');
    }
};
