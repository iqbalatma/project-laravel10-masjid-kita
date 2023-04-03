<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Village;
use App\Services\Masters\VillageService;
use Illuminate\Http\Response;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @param VillageService $service
     * @return \Illuminate\Http\Response
     */
    public function index(VillageService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.villages.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        //
    }
}
