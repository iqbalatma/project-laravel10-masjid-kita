<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Districts\StoreDistrictRequest;
use App\Http\Requests\Masters\Districts\UpdateDistrictRequest;
use App\Services\Masters\DistrictService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DistrictController extends Controller
{
    /**
     * Use to show all data district
     *
     * @param DistrictService $srevice
     * @return Response
     */
    public function index(DistrictService $srevice): Response
    {
        viewShare($srevice->getAllData());
        return response()->view("masters.districts.index");
    }



    /**
     * Use to add new data
     *
     * @param DistrictService $service
     * @param StoreDistrictRequest $request
     * @return RedirectResponse
     */
    public function store(DistrictService $service, StoreDistrictRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Tambah data kabupaten berhasil"]);
    }

    /**
     * Use to update data district
     *
     * @param DistrictService $service
     * @param UpdateDistrictRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(DistrictService $service, UpdateDistrictRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Perbaharui data kabupaten berhasil"]);
    }



    /**
     * Use to delete data by id
     *
     * @param DistrictService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(DistrictService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Hapus data kabupaten berhasil"]);
    }
}
