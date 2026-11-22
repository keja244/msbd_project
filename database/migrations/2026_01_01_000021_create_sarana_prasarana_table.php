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
        Schema::create('sarana_prasarana', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('sarpras_id', true);
            $table->string('nama_fasilitas', 100);
            $table->string('kategori', 50);
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->nullable()->default('Baik');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();

            $table->index('user_id', 'idx_sarpras_user');
            $table->index('kondisi', 'idx_sarpras_kondisi');

            $table->foreign('user_id', 'fk_sarpras_user')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_prasarana');
    }
};
