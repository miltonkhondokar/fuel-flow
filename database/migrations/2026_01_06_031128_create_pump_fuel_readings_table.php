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
        Schema::create('pump_fuel_readings', function (Blueprint $table) {

            $table->bigIncrements('id'); // Primary key
            $table->uuid('uuid')->unique();

            $table->uuid('pump_uuid');       // pumps.uuid
            $table->uuid('fuel_type_uuid');  // fuel_types.uuid

            $table->integer('nozzle_number');  // 1,2,3...
            $table->decimal('reading', 12, 3); // meter reading in liters
            $table->date('reading_date');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index('pump_uuid');
            $table->index('fuel_type_uuid');
            $table->index('nozzle_number');
            $table->index('reading_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_fuel_readings');
    }
};
