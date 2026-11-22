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
        Schema::create('ekskul_galeri', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('galeri_id', true);
            $table->integer('ekskul_id');
            $table->string('path_file', 255);
            $table->text('caption')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('file_foto', 255)->nullable();
            $table->string('keterangan', 255)->nullable();

            $table->index('ekskul_id', 'ekskul_id');

            $table->foreign('ekskul_id', 'ekskul_galeri_ibfk_1')->references('ekskul_id')->on('ekskul_aktivitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskul_galeri');
    }
};
