<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Statics\Permissions\DistrictPermission;
use App\Statics\Permissions\MosquePermission;
use App\Statics\Permissions\MosqueTransactionPermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\SubdistrictPermission;
use App\Statics\Permissions\TransactionPermission;
use App\Statics\Permissions\TransactionTypePermission;
use App\Statics\Permissions\UserManagementPermission;
use App\Statics\Permissions\VillagePermission;
use App\Statics\Roles;
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

        $role = Role::findById(1);
        $role->givePermissionTo(MosqueTransactionPermission::INDEX);
        $role->givePermissionTo(TransactionTypePermission::INDEX);
        $role->givePermissionTo(TransactionTypePermission::STORE);
        $role->givePermissionTo(TransactionTypePermission::UPDATE);
        $role->givePermissionTo(TransactionTypePermission::DESTROY);
        $role->givePermissionTo(TransactionPermission::INDEX);
        $role->givePermissionTo(TransactionPermission::STORE);
        $role->givePermissionTo(TransactionPermission::UPDATE);
        $role->givePermissionTo(TransactionPermission::DESTROY);
        $role->givePermissionTo(VillagePermission::INDEX);
        $role->givePermissionTo(VillagePermission::STORE);
        $role->givePermissionTo(VillagePermission::UPDATE);
        $role->givePermissionTo(VillagePermission::DESTROY);
        $role->givePermissionTo(MosquePermission::INDEX);
        $role->givePermissionTo(MosquePermission::STORE);
        $role->givePermissionTo(MosquePermission::UPDATE);
        $role->givePermissionTo(MosquePermission::DESTROY);
        $role->givePermissionTo(SubdistrictPermission::INDEX);
        $role->givePermissionTo(SubdistrictPermission::STORE);
        $role->givePermissionTo(SubdistrictPermission::UPDATE);
        $role->givePermissionTo(SubdistrictPermission::DESTROY);
        $role->givePermissionTo(DistrictPermission::INDEX);
        $role->givePermissionTo(DistrictPermission::STORE);
        $role->givePermissionTo(DistrictPermission::UPDATE);
        $role->givePermissionTo(DistrictPermission::DESTROY);
        $role->givePermissionTo(RolePermission::INDEX);
        $role->givePermissionTo(RolePermission::CREATE);
        $role->givePermissionTo(RolePermission::STORE);
        $role->givePermissionTo(RolePermission::EDIT);
        $role->givePermissionTo(RolePermission::UPDATE);
        $role->givePermissionTo(RolePermission::DESTROY);
        $role->givePermissionTo(PermissionPermission::INDEX);
        $role->givePermissionTo(UserManagementPermission::INDEX);
        $role->givePermissionTo(UserManagementPermission::STORE);
        $role->givePermissionTo(UserManagementPermission::UPDATE);
        $role->givePermissionTo(UserManagementPermission::DESTROY);
        $role->givePermissionTo(UserManagementPermission::CHANGE_STATUS_ACTIVE);
        $user->assignRole(Roles::SUPERADMIN);
    }
}
