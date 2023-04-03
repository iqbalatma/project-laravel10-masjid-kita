<?php

namespace Database\Seeders;

use App\Models\Village;
use App\Models\Subdistrict;
use Illuminate\Database\Seeder;
use Database\Factories\VillageFactory;
use Illuminate\Support\Facades\Schema;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Subdistrict::truncate();
        Schema::enableForeignKeyConstraints();


        Village::factory()->count(20)->create();
    }
}
