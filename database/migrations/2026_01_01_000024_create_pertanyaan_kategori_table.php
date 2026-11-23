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
        Schema::create('pertanyaan_kategori', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('pertanyaan_id');
            $table->integer('kategori_id');

            $table->primary(['pertanyaan_id', 'kategori_id']);

            $table->index('kategori_id', 'idx_pertanyaan_kategori_kategori');

            $table->foreign('kategori_id', 'fk_pk_kategori')->references('kategori_id')->on('kategori_responden')->onDelete('cascade');
            $table->foreign('pertanyaan_id', 'fk_pk_pertanyaan')->references('pertanyaan_id')->on('pertanyaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_kategori');
    }
};
