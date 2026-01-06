<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PumpComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pump_complaints')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => 'PUT_PUMP_UUID_HERE',
                'category' => 'nozzle_issue', // just string
                'title' => 'Nozzle not dispensing fuel',
                'description' => 'Nozzle #3 is stuck and not dispensing fuel properly',
                'status' => 'open', // string instead of enum
                'complaint_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
