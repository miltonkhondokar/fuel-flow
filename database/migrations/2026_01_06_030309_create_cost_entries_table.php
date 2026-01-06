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
        Schema::create('cost_entries', function (Blueprint $table) {

            $table->bigIncrements('id'); // Primary key
            $table->uuid('uuid')->unique();

            // Soft relations (NO foreign keys)
            $table->uuid('pump_uuid');           // pumps.uuid
            $table->uuid('cost_category_uuid');  // cost_categories.uuid

            // Expense details
            $table->decimal('amount', 12, 2);
            $table->date('expense_date');
            $table->string('reference_no')->nullable();
            $table->text('note')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index('pump_uuid');
            $table->index('cost_category_uuid');
            $table->index('expense_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_entries');
    }
};
