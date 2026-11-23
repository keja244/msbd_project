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
        Schema::create('siswa', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('siswa_id', true);
            $table->integer('user_id')->nullable();
            $table->string('nisn', 20);
            $table->string('nama_lengkap', 100);
            $table->string('kelas', 20);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->year('tahun_masuk');
            $table->enum('status', ['Aktif', 'Lulus', 'Pindah', 'Keluar', 'Alumni'])->nullable()->default('Aktif');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->string('nis', 30)->nullable();
            $table->integer('angkatan')->nullable();

            $table->unique('nisn', 'nisn');
            $table->unique('user_id', 'user_id');
            $table->unique('nis', 'uq_siswa_nis');

            $table->foreign('user_id', 'siswa_ibfk_1')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
