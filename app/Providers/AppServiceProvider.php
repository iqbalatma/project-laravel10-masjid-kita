<?php

namespace App\Providers;

use App\Statics\Permissions\DistrictPermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\UserManagementPermission;
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
        ]);
    }
}
