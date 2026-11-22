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
        Schema::create('ekskul_aktivitas', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('ekskul_id', true);
            $table->string('nama_ekskul', 50);
            $table->integer('pembina_id')->nullable();
            $table->string('jadwal', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->integer('ekskul_master_id')->nullable();
            $table->string('judul_aktivitas', 150)->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('foto_kegiatan', 255)->nullable();

            $table->index('pembina_id', 'pembina_id');

            $table->foreign('pembina_id', 'ekskul_aktivitas_ibfk_1')->references('tendik_id')->on('guru_tendik')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskul_aktivitas');
    }
};
