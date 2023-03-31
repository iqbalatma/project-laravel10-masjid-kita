<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\Masters\SubdistrictController;


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

Route::get('/village', [VillageController::class, 'index'])->name('village');


Route::prefix("masters")->name("masters.")->group(function () {
    Route::prefix("subdistricts")->name("subdistricts.")->controller(SubdistrictController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::patch("/{id}", "update")->name("update");
    });
});
