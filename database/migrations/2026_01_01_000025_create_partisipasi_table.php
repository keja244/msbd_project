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
        Schema::create('partisipasi', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('partisipasi_id', true);
            $table->integer('survei_id');
            $table->integer('kategori_id');
            $table->integer('siswa_id')->nullable();
            $table->timestamp('tanggal_isi')->nullable()->useCurrent();
            $table->string('ip_address', 45)->nullable();
            $table->integer('guru_tendik_id')->nullable();
            $table->char('identitas_hash', 64)->nullable();
            $table->enum('responden_tipe', ['SISWA', 'GURU_TENDIK', 'ANONIM'])->default('ANONIM');
            $table->enum('jenis_responden_eksternal', ['Orang Tua/Wali', 'Masyarakat'])->nullable();
            $table->string('nama_responden', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->text('saran')->nullable();

            $table->unique(['survei_id', 'siswa_id'], 'uq_partisipasi_survei_siswa');
            $table->unique(['survei_id', 'guru_tendik_id'], 'uq_partisipasi_survei_guru');
            $table->unique(['survei_id', 'identitas_hash'], 'uq_partisipasi_survei_anonim');
            $table->index('survei_id', 'survei_id');
            $table->index('kategori_id', 'kategori_id');
            $table->index('siswa_id', 'siswa_id');
            $table->index(['responden_tipe', 'tanggal_isi'], 'idx_partisipasi_tipe_tanggal');
            $table->index('guru_tendik_id', 'idx_partisipasi_guru');

            $table->foreign('guru_tendik_id', 'fk_partisipasi_guru')->references('tendik_id')->on('guru_tendik')->onDelete('restrict');
            $table->foreign('survei_id', 'partisipasi_ibfk_1')->references('survei_id')->on('survei')->onDelete('cascade');
            $table->foreign('kategori_id', 'partisipasi_ibfk_2')->references('kategori_id')->on('kategori_responden')->onDelete('cascade');
            $table->foreign('siswa_id', 'partisipasi_ibfk_3')->references('siswa_id')->on('siswa')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partisipasi');
    }
};
