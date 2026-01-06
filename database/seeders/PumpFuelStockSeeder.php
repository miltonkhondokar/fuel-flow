<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pump;
use App\Models\FuelType;

class PumpFuelStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //fetch a pump and fuel type uuid for seeding
        $pump = Pump::first();
        $fuelType = FuelType::first();


        DB::table('pump_fuel_stocks')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => $pump->uuid,
                'fuel_type_uuid' => $fuelType->uuid,
                'quantity' => 5000.000,
                'purchase_price' => 95.50,
                'total_cost' => 477500.00,
                'reference_no' => 'INIT-STOCK-001',
                'stock_date' => now(),
                'is_initial_stock' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
