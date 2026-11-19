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
        Schema::create('pertanyaan_opsi', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('opsi_id', true);
            $table->integer('pertanyaan_id');
            $table->string('teks_opsi', 255);
            $table->integer('urutan')->default(1);

            $table->unique(['pertanyaan_id', 'teks_opsi'], 'uq_pertanyaan_teks_opsi');
            $table->unique(['pertanyaan_id', 'urutan'], 'uq_pertanyaan_urutan_opsi');
            $table->unique(['pertanyaan_id', 'opsi_id'], 'uq_pertanyaan_opsi_id');

            $table->foreign('pertanyaan_id', 'fk_opsi_pertanyaan')->references('pertanyaan_id')->on('pertanyaan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_opsi');
    }
};
