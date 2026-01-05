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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id')->nullable(); // Just store user ID, no FK
            $table->string('action');
            $table->string('type')->default('others'); // 'user_login', 'password', 'folder', etc.
            $table->unsignedBigInteger('item_id')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps(); // created_at + updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
