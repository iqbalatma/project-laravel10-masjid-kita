<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypes = ["infaq", "hibah", "wakaf", "iuran", "donasi", "zakat", "perawatan", "air", "listrik", "gaji", "operasional", "sumbangan"];
        foreach ($transactionTypes as $key => $type) {
            TransactionType::create(["name" => $type]);
        }
    }
}
