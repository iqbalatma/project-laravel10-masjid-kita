<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        District::truncate();
        Schema::enableForeignKeyConstraints();

        $district = [
            ["code" => "61.01", "name" => "kabupaten sambas"],
            ["code" => "61.02", "name" => "kabupaten mempawah"],
            ["code" => "61.03", "name" => "kabupaten sanggau"],
            ["code" => "61.04", "name" => "kabupaten ketapang"],
            ["code" => "61.05", "name" => "kabupaten sintang"],
            ["code" => "61.06", "name" => "kabupaten kapuas hulu"],
            ["code" => "61.07", "name" => "kabupaten bengkayang"],
            ["code" => "61.08", "name" => "kabupaten landak"],
            ["code" => "61.09", "name" => "kabupaten sekadau"],
            ["code" => "61.10", "name" => "kabupaten melawi"],
            ["code" => "61.11", "name" => "kabupaten kayong utara"],
            ["code" => "61.12", "name" => "kabupaten kuburaya"],
            ["code" => "61.71", "name" => "kota pontianak"],
            ["code" => "61.72", "name" => "kota singkawang"],
        ];

        foreach ($district as $key => $subdistrict) {
            District::create($subdistrict);
        }
    }
}
