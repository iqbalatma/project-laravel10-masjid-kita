<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Village;
use App\Http\Requests\Masters\Villages\StoreVillageRequest;
use App\Services\Masters\VillageService;
use Illuminate\Http\RedirectResponse;
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
     * @param VillageService $service
     * @param StoreVillageRequest $request
     * @return RedirectResponse
     */
    public function store(VillageService $service, StoreVillageRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse()->withInput();

        return redirect()->back()->with(["success" => "Tambah data desa berhasil"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(VillageService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Hapus data desa berhasil"]);
    }
}
