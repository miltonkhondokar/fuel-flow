<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pump;
use App\Models\FuelType;

class PumpFuelPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //fetch pum and pump uuids
        $pump = Pump::first();
        $fuelType = FuelType::first();


        DB::table('pump_fuel_prices')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => $pump->uuid,
                'fuel_type_uuid' => $fuelType->uuid,
                'price_per_unit' => 110.50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
