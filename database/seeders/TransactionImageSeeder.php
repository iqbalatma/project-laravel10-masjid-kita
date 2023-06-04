<?php

namespace Database\Seeders;

use App\Models\TransactionImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionImage::create([
            "image" => "s",
            "user_id" => 1,
            "transaction_id" => 1
        ]);
    }
}
