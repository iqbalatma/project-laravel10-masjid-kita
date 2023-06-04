<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Mosques\StoreMosqueRequest;
use App\Http\Requests\Masters\Mosques\UpdateMosqueRequest;
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

    /**
     * Use to update data mosoque
     *
     * @param MosqueService $service
     * @param UpdateMosqueRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(MosqueService $service, UpdateMosqueRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Perbaharui data masjid berhasil"]);
    }

    /**
     * Use to delete data by id
     *
     * @param MosqueService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(MosqueService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Hapus data masjid berhasil"]);
    }
}
