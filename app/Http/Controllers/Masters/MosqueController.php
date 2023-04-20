<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Mosques\StoreMosqueRequest;
use App\Services\Masters\MosqueService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MosqueController extends Controller
{
    /**
     * Use to show mosqu index
     *
     * @param MosqueService $service
     * @return Response
     */
    public function index(MosqueService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.mosques.index");
    }


    /**
     * Use to add new data
     *
     * @param MosqueService $service
     * @param StoreMosqueRequest $request
     * @return RedirectResponse
     */
    public function store(MosqueService $service, StoreMosqueRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Tambah data masjid berhasil"]);
    }
}
