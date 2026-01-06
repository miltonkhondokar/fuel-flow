<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PumpFuelReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pump_fuel_readings')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => 'PUT_PUMP_UUID_HERE',
                'fuel_type_uuid' => 'PUT_FUEL_TYPE_UUID_HERE',
                'nozzle_number' => 1,
                'reading' => 5000.000,
                'reading_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => 'PUT_PUMP_UUID_HERE',
                'fuel_type_uuid' => 'PUT_FUEL_TYPE_UUID_HERE',
                'nozzle_number' => 2,
                'reading' => 5000.000,
                'reading_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
