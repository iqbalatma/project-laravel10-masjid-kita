<?php

namespace App\Providers;

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
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        viewShare([
            "permissionPermissions" => PermissionPermission::class,
            "rolePermissions" => RolePermission::class,
            "userManagementPermissions" => UserManagementPermission::class,
            "districtPermissions" => DistrictPermission::class,
            "subdistrictPermissions" => SubdistrictPermission::class,
            "villagePermissions" => VillagePermission::class,
            "mosquePermissions" => MosquePermission::class,
            "transactionPermissions" => TransactionPermission::class,
            "transactionTypePermissions" => TransactionTypePermission::class,
            "mosqueTransactionPermissions" => MosqueTransactionPermission::class,
        ]);
    }
}
