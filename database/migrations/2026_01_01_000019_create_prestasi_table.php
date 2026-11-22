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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('prestasi_id', true);
            $table->string('nama_kejuaraan', 150);
            $table->enum('tingkat', ['Kabupaten', 'Provinsi', 'Nasional', 'Internasional']);
            $table->string('juara', 50);
            $table->year('tahun');
            $table->string('penyelenggara', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->integer('ekskul_id')->nullable();
            $table->string('nama_kegiatan', 150)->nullable();
            $table->text('keterangan')->nullable();

            $table->index('ekskul_id', 'idx_prestasi_ekskul');
            $table->index(['tahun', 'tingkat'], 'idx_prestasi_tahun_tingkat');

            $table->foreign('ekskul_id', 'fk_prestasi_ekskul')->references('ekskul_id')->on('ekskul_aktivitas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
