<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pumps')->insert([
            [
                'uuid' => Str::uuid(),
                'user_uuid' => null,
                'name' => 'Fuel Flow Station – Dhaka',
                'location' => 'Dhaka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'user_uuid' => null,
                'name' => 'Fuel Flow Station – Chattogram',
                'location' => 'Chattogram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
