<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
        foreach (RoleEnum::cases() as $role) {
            Role::create(["name" => $role]);
        }

        $admin = Role::findById(2);
        foreach (PermissionEnum::cases() as $permission) {
            $admin->givePermissionTo($permission->value);
        }
        $admin->revokePermissionTo(PermissionEnum::PERMISSION_INDEX->value);
        $admin->revokePermissionTo(PermissionEnum::ROLE_UPDATE->value);
        $admin->revokePermissionTo(PermissionEnum::ROLE_EDIT->value);
        $admin->revokePermissionTo(PermissionEnum::ROLE_STORE->value);
        $admin->revokePermissionTo(PermissionEnum::ROLE_DESTROY->value);
        $admin->revokePermissionTo(PermissionEnum::USER_MANAGEMENT_DESTROY->value);
        $admin->revokePermissionTo(PermissionEnum::USER_MANAGEMENT_UPDATE->value);
        $admin->revokePermissionTo(PermissionEnum::USER_MANAGEMENT_STORE->value);
        $admin->revokePermissionTo(PermissionEnum::USER_MANAGEMENT_CHANGE_STATUS_ACTIVE->value);
        $admin->revokePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_INDEX->value);
        $admin->revokePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_STORE->value);
        $admin->revokePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_APPROVAL->value);

        $stafInputMasjid = Role::findById(3);
        $stafInputMasjid->givePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_STORE->value);
        $stafInputMasjid->givePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_INDEX->value);

        $bendaharaMasjid = Role::findById(4);
        $bendaharaMasjid->givePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_INDEX->value);
        $bendaharaMasjid->givePermissionTo(PermissionEnum::MOSQUE_TRANSACTION_APPROVAL->value);
    }
}
