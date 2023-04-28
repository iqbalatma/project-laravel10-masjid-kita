<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Statics\Permissions\DistrictPermission;
use App\Statics\Permissions\MosquePermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\SubdistrictPermission;
use App\Statics\Permissions\TransactionPermission;
use App\Statics\Permissions\TransactionTypePermission;
use App\Statics\Permissions\UserManagementPermission;
use App\Statics\Permissions\VillagePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();
        foreach ((new \ReflectionClass(RolePermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(PermissionPermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(UserManagementPermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(DistrictPermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(SubdistrictPermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(VillagePermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(MosquePermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(TransactionPermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
        foreach ((new \ReflectionClass(TransactionTypePermission::class))->getConstants() as $key => $value) {
            Permission::create(["name" => $value]);
        }
    }
}
