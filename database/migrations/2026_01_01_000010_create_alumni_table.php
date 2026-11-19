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
        Schema::create('alumni', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('alumni_id', true);
            $table->integer('siswa_id');
            $table->year('tahun_lulus')->nullable();
            $table->string('perguruan_tinggi', 150)->nullable();
            $table->string('jenjang_lanjutan', 100)->nullable();
            $table->string('jurusan_lanjutan', 100)->nullable();
            $table->string('jalur_masuk', 100)->nullable();
            $table->string('pekerjaan_saat_ini', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->unique('siswa_id', 'uq_alumni_siswa');

            $table->foreign('siswa_id', 'fk_alumni_siswa')->references('siswa_id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
