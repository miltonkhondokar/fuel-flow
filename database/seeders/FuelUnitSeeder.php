<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FuelUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Liter', 'abbreviation' => 'L', 'description' => 'Standard liter unit (metric)'],
            ['name' => 'Milliliter', 'abbreviation' => 'mL', 'description' => '1/1000 of a liter'],
            ['name' => 'US Gallon', 'abbreviation' => 'gal', 'description' => 'US customary gallon (~3.785 L)'],
            ['name' => 'Imperial Gallon', 'abbreviation' => 'imp gal', 'description' => 'UK gallon (~4.546 L)'],
            ['name' => 'Barrel', 'abbreviation' => 'bbl', 'description' => 'Standard oil barrel (~159 L)'],
            ['name' => 'Cubic Meter', 'abbreviation' => 'm³', 'description' => 'Metric cubic meter (1000 L)'],
            ['name' => 'US Pint', 'abbreviation' => 'pt', 'description' => 'US pint (~0.473 L)'],
            ['name' => 'US Quart', 'abbreviation' => 'qt', 'description' => 'US quart (~0.946 L)'],
            ['name' => 'UK Pint', 'abbreviation' => 'imp pt', 'description' => 'UK pint (~0.568 L)'],
            ['name' => 'UK Quart', 'abbreviation' => 'imp qt', 'description' => 'UK quart (~1.136 L)'],
            ['name' => 'US Fluid Ounce', 'abbreviation' => 'fl oz', 'description' => 'US fluid ounce (~29.573 mL)'],
            ['name' => 'UK Fluid Ounce', 'abbreviation' => 'fl oz (imp)', 'description' => 'UK fluid ounce (~28.41 mL)'],
            ['name' => 'Deciliter', 'abbreviation' => 'dL', 'description' => '1/10 of a liter'],
            ['name' => 'Cubic Foot', 'abbreviation' => 'ft³', 'description' => 'Imperial cubic foot (~28.316 L)'],
            ['name' => 'Cubic Inch', 'abbreviation' => 'in³', 'description' => 'Small volume (~16.387 mL)'],
        ];

        foreach ($units as $unit) {
            DB::table('fuel_units')->insert([
                'uuid' => (string) Str::uuid(),
                'name' => $unit['name'],
                'abbreviation' => $unit['abbreviation'],
                'description' => $unit['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
