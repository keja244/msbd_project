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
        Schema::create('ekskul_organisasi', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('org_id', true);
            $table->integer('ekskul_id');
            $table->integer('siswa_id');
            $table->string('jabatan', 50);
            $table->string('periode', 20);
            $table->integer('ekskul_master_id')->nullable();

            $table->index('ekskul_id', 'ekskul_id');
            $table->index('siswa_id', 'siswa_id');
            $table->index('ekskul_master_id', 'fk_ekskul_org_master');

            $table->foreign('ekskul_id', 'ekskul_organisasi_ibfk_1')->references('ekskul_id')->on('ekskul_aktivitas')->onDelete('cascade');
            $table->foreign('siswa_id', 'ekskul_organisasi_ibfk_2')->references('siswa_id')->on('siswa')->onDelete('cascade');
            $table->foreign('ekskul_master_id', 'fk_ekskul_org_master')->references('ekskul_master_id')->on('ekskul_master')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskul_organisasi');
    }
};
