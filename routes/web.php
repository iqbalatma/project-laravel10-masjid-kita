<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masters\DistrictController;
use App\Http\Controllers\Masters\PermissionController;
use App\Http\Controllers\Masters\RoleController;
use App\Http\Controllers\Masters\VillageController;
use App\Http\Controllers\Masters\SubdistrictController;
use App\Statics\Permissions\PermissionPermission;

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

Route::prefix("masters")->name("masters.")->group(function () {
    // PERMISSIONS
    Route::get("/permissions", PermissionController::class)->name("permissions.index");

    // ROLES
    Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::get("/edit/{id}", "edit")->name("edit");
        Route::post("/", "store")->name("store");
        Route::delete("/{id}", "destroy")->name("destroy");
        Route::put("/{id}", "update")->name("update");
    });

    // SUBDISTRICT
    Route::prefix("subdistricts")->name("subdistricts.")->controller(SubdistrictController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    // DISTRICTS
    Route::prefix("districts")->name("districts.")->controller(DistrictController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    // VILLAGES
    Route::prefix("villages")->name("villages.")->controller(VillageController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
    });
});
