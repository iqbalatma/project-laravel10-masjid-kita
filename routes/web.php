<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masters\TransactionTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masters\DistrictController;
use App\Http\Controllers\Masters\MosqueController;
use App\Http\Controllers\UserManagements\PermissionController;
use App\Http\Controllers\UserManagements\RoleController;
use App\Http\Controllers\Masters\VillageController;
use App\Http\Controllers\Masters\SubdistrictController;
use App\Http\Controllers\Mosques\MosqueTransactionController;
use App\Http\Controllers\Transactions\TransactionController;
use App\Http\Controllers\UserManagements\UserManagementController;

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

Route::get("/", \App\Http\Controllers\DashboardController::class)->name("dashboard");

Route::prefix("auth")->name("auth.")->controller(AuthController::class)->group(function () {
    Route::get("/", "login")->name("login");
    Route::post("/", "authenticate")->name("authenticate");
    Route::get("/logout", "logout")->name("logout")->middleware("auth");
});

Route::middleware("auth")->group(function () {

    Route::prefix("/ajax")->name("ajax.")->group(function (){
        Route::get("/dashboard", \App\Http\Controllers\AJAX\DashboardController::class)->name("dashboard");
    });

    Route::get("images/{path}", \App\Http\Controllers\ImageController::class)->name("images");


//    PROFILE
    Route::prefix("profile")->name("profile.")->controller(\App\Http\Controllers\Profiles\ProfileController::class)->group(function (){
        Route::get("/", 'edit')->name("edit");
        Route::patch("/", 'update')->name("update");
    });


//    USER MANAGEMENTS
    Route::prefix("user-managements")->name("user.managements.")->group(function () {
        // USER MANAGEMENT
        Route::prefix("/users")->name("users.")->controller(UserManagementController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::USER_MANAGEMENT_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::USER_MANAGEMENT_STORE->value);
            Route::patch("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::USER_MANAGEMENT_UPDATE->value);
            Route::put("/{id}", "changeStatusActive")->name("change.status.active")->middleware("permission:" . \App\Enums\PermissionEnum::USER_MANAGEMENT_CHANGE_STATUS_ACTIVE->value);
        });

        // PERMISSIONS
        Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . \App\Enums\PermissionEnum::PERMISSION_INDEX->value);

        // ROLES
        Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_INDEX->value);
            Route::get("/create", "create")->name("create")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_CREATE->value);
            Route::get("/edit/{id}", "edit")->name("edit")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_EDIT->value);;
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_STORE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_DESTROY->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::ROLE_UPDATE->value);
        });
    });

//    MASTERS
    Route::prefix("masters")->name("masters.")->group(function () {
        // TRANSACTION TYPE
        Route::prefix("transaction-types")->name("transaction.types.")->controller(TransactionTypeController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_TYPE_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_TYPE_STORE->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_TYPE_UPDATE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_TYPE_DESTROY->value);
        });


        // MOSQUES
        Route::prefix("mosques")->name("mosques.")->controller(MosqueController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_STORE->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_UPDATE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_DESTROY->value);
        });

        // DISTRICTS
        Route::prefix("districts")->name("districts.")->controller(DistrictController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::DISTRICT_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::DISTRICT_STORE->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::DISTRICT_UPDATE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::DISTRICT_DESTROY->value);
        });


        // SUBDISTRICT
        Route::prefix("subdistricts")->name("subdistricts.")->controller(SubdistrictController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::SUBDISTRICT_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::SUBDISTRICT_STORE->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::SUBDISTRICT_UPDATE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::SUBDISTRICT_DESTROY->value);
        });


        // VILLAGES
        Route::prefix("villages")->name("villages.")->controller(VillageController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::VILLAGE_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::VILLAGE_STORE->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . \App\Enums\PermissionEnum::VILLAGE_UPDATE->value);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . \App\Enums\PermissionEnum::VILLAGE_DESTROY->value);
        });
    });

//    TRANSACTIONS
    Route::prefix("transactions")->name("transactions.")->group(function () {
        Route::controller(TransactionController::class)->group(function () {
            Route::get("/{type}", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_INDEX->value);
            Route::put("/{id}", "approval")->name("approval")->middleware("permission:" . \App\Enums\PermissionEnum::TRANSACTION_APPROVAL->value);
        });
    });

//    MOSQUES
    Route::prefix("mosques/{mosque_id}")->name("mosque.")->group(function () {
        Route::prefix("transactions")->name("transactions.")->controller(MosqueTransactionController::class)->group(function () {
            Route::get("/{type}", "index")->name("index")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_TRANSACTION_INDEX->value);
            Route::post("/", "store")->name("store")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_TRANSACTION_STORE->value);
            Route::put("/{id}", "approval")->name("approval")->middleware("permission:" . \App\Enums\PermissionEnum::MOSQUE_TRANSACTION_APPROVAL->value);
        });
    });
});
