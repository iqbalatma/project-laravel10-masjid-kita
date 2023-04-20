<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Statics\Permissions\DistrictPermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\UserManagementPermission;
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
