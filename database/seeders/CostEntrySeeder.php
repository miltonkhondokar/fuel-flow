<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CostEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cost_entries')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => 'PUT_PUMP_UUID_HERE',
                'cost_category_uuid' => 'PUT_COST_CATEGORY_UUID_HERE',
                'amount' => 15000.00,
                'expense_date' => now(),
                'reference_no' => 'EXP-001',
                'note' => 'Generator maintenance',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
