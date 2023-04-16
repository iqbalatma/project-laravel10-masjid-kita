<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Subdistricts\StoreSubdistrictRequest;
use App\Http\Requests\Masters\Subdistricts\UpdateSubdistrictRequest;
use App\Services\Masters\SubdistrictService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SubdistrictController extends Controller
{

    /**
     * Use to get all data index
     *
     * @param SubdistrictService $service
     * @return Response
     */
    public function index(SubdistrictService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.subdistricts.index");
    }


    /**
     * use to add new subdsitrcit
     *
     * @param SubdistrictService $service
     * @param StoreSubdistrictRequest $request
     * @return RedirectResponse
     */
    public function store(SubdistrictService $service, StoreSubdistrictRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Add new data subdistrict successfully"]);
    }


    /**
     * Use to update data subdistrict
     *
     * @param SubdistrictService $service
     * @param UpdateSubdistrictRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(SubdistrictService $service, UpdateSubdistrictRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Update data subdistrict successfully"]);
    }
}
