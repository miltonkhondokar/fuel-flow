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
        Schema::create('pump_complaints', function (Blueprint $table) {

            $table->bigIncrements('id'); // Primary key
            $table->uuid('uuid')->unique();

            // Soft relation
            $table->uuid('pump_uuid'); // pumps.uuid

            // Fixed categories stored as string (flexible)
            $table->string('category'); // e.g., fuel_shortage, nozzle_issue, power_failure
            $table->string('title');
            $table->text('description')->nullable();

            // Status as string
            $table->string('status')->default('open'); // open, in_progress, resolved
            $table->date('complaint_date');
            $table->date('resolved_date')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index('pump_uuid');
            $table->index('category');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_complaints');
    }
};
