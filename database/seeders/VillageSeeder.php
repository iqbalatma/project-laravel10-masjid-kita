<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;
use Database\Factories\VillageFactory;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Village::factory()->count(20)->create();
    }
}
