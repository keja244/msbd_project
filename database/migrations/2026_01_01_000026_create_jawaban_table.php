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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('jawaban_id', true);
            $table->integer('survei_id');
            $table->integer('partisipasi_id');
            $table->integer('pertanyaan_id');
            $table->integer('opsi_id')->nullable();
            $table->integer('kategori_id');
            $table->tinyInteger('skor')->nullable();
            $table->text('isian')->nullable();

            $table->unique(['partisipasi_id', 'pertanyaan_id'], 'uq_jawaban_partisipasi_pertanyaan');
            $table->index('survei_id', 'survei_id');
            $table->index('partisipasi_id', 'partisipasi_id');
            $table->index('pertanyaan_id', 'pertanyaan_id');
            $table->index('kategori_id', 'kategori_id');
            $table->index(['survei_id', 'pertanyaan_id', 'skor'], 'idx_jawaban_survei_pertanyaan_skor');
            $table->index(['pertanyaan_id', 'opsi_id'], 'fk_jawaban_opsi');

            $table->foreign(['pertanyaan_id', 'opsi_id'], 'fk_jawaban_opsi')->references(['pertanyaan_id', 'opsi_id'])->on('pertanyaan_opsi')->onDelete('restrict');
            $table->foreign('survei_id', 'jawaban_ibfk_1')->references('survei_id')->on('survei')->onDelete('cascade');
            $table->foreign('partisipasi_id', 'jawaban_ibfk_2')->references('partisipasi_id')->on('partisipasi')->onDelete('cascade');
            $table->foreign('pertanyaan_id', 'jawaban_ibfk_3')->references('pertanyaan_id')->on('pertanyaan')->onDelete('cascade');
            $table->foreign('kategori_id', 'jawaban_ibfk_4')->references('kategori_id')->on('kategori_responden')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
