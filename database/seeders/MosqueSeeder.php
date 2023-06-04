<?php

namespace Database\Seeders;

use App\Models\Mosque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MosqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mosque::factory()->count(100)->create();
    }
}
