<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pump;
use App\Models\FuelType;

class PumpFuelReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch first active pump
        $pump = Pump::where('is_active', true)->first();

        // Fetch first active fuel type
        $fuelType = FuelType::where('is_active', true)->first();

        // Safety check (very important)
        if (!$pump || !$fuelType) {
            $this->command->warn('Pump or FuelType not found. Skipping PumpFuelReadingSeeder.');
            return;
        }

        DB::table('pump_fuel_readings')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => $pump->uuid,
                'fuel_type_uuid' => $fuelType->uuid,
                'nozzle_number' => 1,
                'reading' => 5000.000,
                'reading_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => $pump->uuid,
                'fuel_type_uuid' => $fuelType->uuid,
                'nozzle_number' => 2,
                'reading' => 5000.000,
                'reading_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
