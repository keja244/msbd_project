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
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('pertanyaan_id', true);
            $table->integer('survei_id');
            $table->integer('aspek_id');
            $table->text('teks_pertanyaan');
            $table->enum('jenis', ['Skala', 'Pilihan', 'Esai'])->nullable()->default('Skala');
            $table->integer('urutan')->nullable()->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->boolean('inti')->default(0);
            $table->boolean('aktif')->default(1);
            $table->softDeletes();

            $table->index('survei_id', 'survei_id');
            $table->index('aspek_id', 'aspek_id');
            $table->index(['survei_id', 'aktif', 'urutan'], 'idx_pertanyaan_aktif');
            $table->index('deleted_at', 'idx_pertanyaan_deleted');
            $table->index(['aspek_id', 'survei_id'], 'fk_pertanyaan_aspek_survei');

            $table->foreign(['aspek_id', 'survei_id'], 'fk_pertanyaan_aspek_survei')->references(['aspek_id', 'survei_id'])->on('aspek_kategori')->onDelete('restrict');
            $table->foreign('survei_id', 'pertanyaan_ibfk_1')->references('survei_id')->on('survei')->onDelete('cascade');
            $table->foreign('aspek_id', 'pertanyaan_ibfk_2')->references('aspek_id')->on('aspek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};
