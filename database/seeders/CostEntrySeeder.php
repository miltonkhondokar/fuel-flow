<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pump;
use App\Models\CostCategory;

class CostEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //fetch pump and pump uuids
        $pump = Pump::first();
        $costCategory = CostCategory::first();

        DB::table('cost_entries')->insert([
            [
                'uuid' => Str::uuid(),
                'pump_uuid' => $pump->uuid,
                'cost_category_uuid' => $costCategory->uuid,
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
