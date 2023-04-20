<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Subdistrict::truncate();
        Schema::enableForeignKeyConstraints();

        $subdistricts = [
            ["district_id" => 1, "code" => "61.01.11", "name" => "galing"],
            ["district_id" => 1, "code" => "61.01.03", "name" => "jawai"],
            ["district_id" => 1, "code" => "61.01.16", "name" => "jawai selatan"],
            ["district_id" => 1, "code" => "61.01.08", "name" => "paloh"],
            ["district_id" => 1, "code" => "61.01.05", "name" => "pemangkat"],
            ["district_id" => 1, "code" => "61.01.14", "name" => "sajad"],
            ["district_id" => 1, "code" => "61.01.09", "name" => "sajingan besar"],
            ["district_id" => 1, "code" => "61.01.18", "name" => "salatiga"],
            ["district_id" => 1, "code" => "61.01.01", "name" => "sambas"],
            ["district_id" => 1, "code" => "61.01.15", "name" => "sebawi"],
            ["district_id" => 1, "code" => "61.01.06", "name" => "sejangkung"],
            ["district_id" => 1, "code" => "61.01.07", "name" => "selakau"],
            ["district_id" => 1, "code" => "61.01.19", "name" => "selakau timur"],
            ["district_id" => 1, "code" => "61.01.13", "name" => "semparuk"],
            ["district_id" => 1, "code" => "61.01.10", "name" => "subah"],
            ["district_id" => 1, "code" => "61.01.17", "name" => "tangaran"],
            ["district_id" => 1, "code" => "61.01.04", "name" => "tebas"],
            ["district_id" => 1, "code" => "61.01.12", "name" => "tekarang"],
            ["district_id" => 1, "code" => "61.01.02", "name" => "teluk keramat"],
        ];

        foreach ($subdistricts as $key => $subdistrict) {
            Subdistrict::create($subdistrict);
        }
    }
}
