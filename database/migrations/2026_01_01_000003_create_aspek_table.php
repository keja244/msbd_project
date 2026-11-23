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
        Schema::create('aspek', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('aspek_id', true);
            $table->string('nama_aspek', 100);
            $table->decimal('bobot', 5, 2)->nullable()->default('1.00');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->text('deskripsi')->nullable();
            $table->boolean('bersama')->default(1);

            $table->unique('nama_aspek', 'uq_aspek_nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspek');
    }
};
