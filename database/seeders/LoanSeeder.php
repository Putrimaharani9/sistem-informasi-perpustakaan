<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loan::factory()->create([
            'created_by' => 1,
            'copy_id' => 1,
            'member_id' => Member::factory()->create(['created_by' => 1])->id
        ]);
    }
}
