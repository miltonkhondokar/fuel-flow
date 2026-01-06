<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\FuelUnit;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $literUnitUuid = FuelUnit::where('abbreviation', 'L')->first()->uuid;


        DB::table('fuel_types')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Petrol',
                'code' => 'PET',
                'rating_value' => 92,
                'unit_uuid' => $literUnitUuid,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Diesel',
                'code' => 'DSL',
                'rating_value' => 45,
                'unit_uuid' => $literUnitUuid,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Octane',
                'code' => 'OCT',
                'rating_value' => 98,
                'unit_uuid' => $literUnitUuid,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
