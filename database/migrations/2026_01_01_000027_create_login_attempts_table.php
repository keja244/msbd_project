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
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->bigInteger('attempt_id', true);
            $table->integer('user_id')->nullable();
            $table->char('identifier_hash', 64);
            $table->string('ip_address', 45)->nullable();
            $table->boolean('berhasil')->default(0);
            $table->timestamp('attempted_at')->useCurrent();

            $table->index(['identifier_hash', 'attempted_at'], 'idx_login_identifier_time');
            $table->index(['user_id', 'attempted_at'], 'idx_login_user_time');

            $table->foreign('user_id', 'fk_login_attempt_user')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_attempts');
    }
};
