<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "iqbal atma muliawan",
            "email" => "iqbalatma@gmail.com",
            "phone" => "+62895351172040",
            "address" => "selakau",
            "email_verified_at" => now(),
            "password" => "admin"
        ]);
        $user->assignRole(RoleEnum::ADMIN->value);

        $user = User::create([
            "name" => "iqbal atma muliawan",
            "email" => "iqbalatma2@gmail.com",
            "phone" => "+62895351172040",
            "address" => "selakau",
            "email_verified_at" => now(),
            "password" => "admin"
        ]);
        $user->assignRole(RoleEnum::STAFF_INPUT_MASJID->value);
        $user->mosques()->attach(1);

        $user = User::create([
            "name" => "iqbal atma muliawan",
            "email" => "iqbalatma3@gmail.com",
            "phone" => "+62895351172040",
            "address" => "selakau",
            "email_verified_at" => now(),
            "password" => "admin"
        ]);
        $user->assignRole(RoleEnum::BENDAHARA_MASJID->value);
        $user->mosques()->attach(1);
    }
}
