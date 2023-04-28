<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\TransactionTypes\StoreTransactionTypeRequest;
use App\Http\Requests\Masters\TransactionTypes\UpdateTransactionTypeRequest;
use App\Services\Masters\TransactionTypeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TransactionTypeController extends Controller
{

    /**
     * Use to show list of all data
     *
     * @param TransactionTypeService $service
     * @return Response
     */
    public function index(TransactionTypeService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.transaction-types.index");
    }

    /**
     * Use to update data mosoque
     *
     * @param TransactionTypeService $service
     * @param UpdateTransactionTypeRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(TransactionTypeService $service, UpdateTransactionTypeRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Perbaharui data tipe transaksi berhasil"]);
    }

    /**
     * Use to add new data transaction
     *
     * @param TransactionTypeService $service
     * @param StoreTransactionTypeRequest $request
     * @return RedirectResponse
     */
    public function store(TransactionTypeService $service, StoreTransactionTypeRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Tambah data tipe transaksi berhasil"]);
    }

    /**
     * Use to delete data by id
     *
     * @param TransactionTypeService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(TransactionTypeService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with(["success" => "Hapus data tipe transaksi berhasil"]);
    }
}
