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
        Schema::create('role_aspek', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->integer('role_id');
            $table->integer('aspek_id');

            $table->primary(['role_id', 'aspek_id']);

            $table->index('aspek_id', 'fk_role_aspek_aspek');

            $table->foreign('aspek_id', 'fk_role_aspek_aspek')->references('aspek_id')->on('aspek')->onDelete('cascade');
            $table->foreign('role_id', 'fk_role_aspek_role')->references('role_id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_aspek');
    }
};
