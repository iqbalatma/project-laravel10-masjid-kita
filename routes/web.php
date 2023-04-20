<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masters\DistrictController;
use App\Http\Controllers\Masters\PermissionController;
use App\Http\Controllers\Masters\RoleController;
use App\Http\Controllers\Masters\VillageController;
use App\Http\Controllers\Masters\SubdistrictController;
use App\Statics\Permissions\DistrictPermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\SubdistrictPermission;
use App\Statics\Permissions\VillagePermission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("auth")->name("auth.")->controller(AuthController::class)->group(function () {
    Route::get("/", "login")->name("login");
    Route::post("/", "authenticate")->name("authenticate");
    Route::post("/logout", "logout")->name("logout")->middleware("auth");
});

Route::middleware("auth")->group(function () {
    Route::prefix("masters")->name("masters.")->group(function () {
        // PERMISSIONS
        Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . PermissionPermission::INDEX);

        // ROLES
        Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . RolePermission::INDEX);
            Route::get("/create", "create")->name("create")->middleware("permission:" . RolePermission::CREATE);
            Route::get("/edit/{id}", "edit")->name("edit")->middleware("permission:" . RolePermission::EDIT);;
            Route::post("/", "store")->name("store")->middleware("permission:" . RolePermission::STORE);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . RolePermission::DESTROY);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . RolePermission::UPDATE);
        });

        // DISTRICTS
        Route::prefix("districts")->name("districts.")->controller(DistrictController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . DistrictPermission::INDEX);
            Route::post("/", "store")->name("store")->middleware("permission:" . DistrictPermission::STORE);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . DistrictPermission::UPDATE);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . DistrictPermission::DESTROY);
        });


        // SUBDISTRICT
        Route::prefix("subdistricts")->name("subdistricts.")->controller(SubdistrictController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . SubdistrictPermission::INDEX);
            Route::post("/", "store")->name("store")->middleware("permission:" . SubdistrictPermission::STORE);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . SubdistrictPermission::UPDATE);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . SubdistrictPermission::DESTROY);
        });


        // VILLAGES
        Route::prefix("villages")->name("villages.")->controller(VillageController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . VillagePermission::INDEX);
            Route::post("/", "store")->name("store")->middleware("permission:" . VillagePermission::STORE);
        });
    });
});
