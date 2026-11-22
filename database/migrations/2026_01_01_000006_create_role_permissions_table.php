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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('role_permission_id', true);
            $table->integer('role_id');
            $table->unsignedInteger('permission_id');
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->unique(['role_id', 'permission_id'], 'unique_role_permission');
            $table->index('permission_id', 'fk_role_permissions_permission');

            $table->foreign('permission_id', 'fk_role_permissions_permission')->references('permission_id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id', 'fk_role_permissions_role')->references('role_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
