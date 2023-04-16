<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Districts\UpdateDistrictRequest;
use App\Services\Masters\DistrictService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
}
