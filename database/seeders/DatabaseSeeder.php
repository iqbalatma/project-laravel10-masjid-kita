<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SubdistrictSeeder::class,
            VillageSeeder::class,
            DistrictSeeder::class,
            UserSeeder::class,
            MosqueSeeder::class,
            TransactionTypeSeeder::class,
            TransactionSeeder::class
        ]);
    }
}
