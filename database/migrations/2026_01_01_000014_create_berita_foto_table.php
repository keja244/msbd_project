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
        Schema::create('berita_foto', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('foto_id', true);
            $table->integer('berita_id');
            $table->string('path_file', 255);
            $table->string('keterangan', 100)->nullable();
            $table->string('file_foto', 255)->nullable();

            $table->index('berita_id', 'berita_id');

            $table->foreign('berita_id', 'berita_foto_ibfk_1')->references('berita_id')->on('berita')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_foto');
    }
};
