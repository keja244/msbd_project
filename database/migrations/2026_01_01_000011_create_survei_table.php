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
        Schema::create('survei', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('survei_id', true);
            $table->string('judul_survei', 150);
            $table->text('deskripsi')->nullable();
            $table->string('tahun_ajaran', 20);
            $table->tinyInteger('semester');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['Aktif', 'Selesai', 'Arsip'])->nullable()->default('Aktif');
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->enum('metode_ikm', ['INTERNAL', 'KONVERSI', 'BOTH'])->default('BOTH');
            $table->tinyInteger('skala_min')->default(1);
            $table->tinyInteger('skala_max')->default(4);
            $table->decimal('faktor_konversi', 6, 2)->default('25.00');

            $table->index('created_by', 'created_by');

            $table->foreign('created_by', 'survei_ibfk_1')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei');
    }
};
