<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Subdistricts\StoreSubdistrictRequest;
use App\Services\Masters\SubdistrictService;
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

    public function store(SubdistrictService $service, StoreSubdistrictRequest $request)
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Add new data subdistrict successfully"]);
    }
}
