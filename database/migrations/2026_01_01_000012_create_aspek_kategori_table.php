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
        Schema::create('aspek_kategori', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('id', true);
            $table->integer('aspek_id');
            $table->integer('survei_id');
            $table->integer('kategori_id')->nullable();

            $table->unique(['aspek_id', 'survei_id'], 'uq_aspek_survei');
            $table->index('aspek_id', 'aspek_id');
            $table->index('survei_id', 'survei_id');
            $table->index('kategori_id', 'idx_aspek_kategori_kategori');

            $table->foreign('aspek_id', 'aspek_kategori_ibfk_1')->references('aspek_id')->on('aspek')->onDelete('cascade');
            $table->foreign('survei_id', 'aspek_kategori_ibfk_2')->references('survei_id')->on('survei')->onDelete('cascade');
            $table->foreign('kategori_id', 'fk_aspek_kategori_responden')->references('kategori_id')->on('kategori_responden')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspek_kategori');
    }
};
