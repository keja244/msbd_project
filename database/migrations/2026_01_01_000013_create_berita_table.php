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
        Schema::create('berita', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('berita_id', true);
            $table->string('judul', 150);
            $table->string('slug', 160);
            $table->text('konten');
            $table->string('kategori', 50)->nullable();
            $table->enum('status', ['Draft', 'Published'])->nullable()->default('Published');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->string('gambar_utama', 255)->nullable();

            $table->unique('slug', 'slug');
            $table->index('user_id', 'idx_berita_user');
            $table->index(['status', 'created_at'], 'idx_berita_status_tanggal');

            $table->foreign('user_id', 'fk_berita_user')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
