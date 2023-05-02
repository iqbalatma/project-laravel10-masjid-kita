<?php

namespace App\Http\Controllers\Mosques;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mosques\StoreMosqueTransactionRequest;
use App\Services\Mosques\MosqueTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MosqueTransactionController extends Controller
{

    /**
     * Use to show transaction by mosque id
     *
     * @param MosqueTransactionService $service
     * @param integer $mosqueId
     * @return Response
     */
    public function index(MosqueTransactionService $service, int $mosqueId): Response
    {
        viewShare($service->getAllData($mosqueId));
        return response()->view("mosques.transactions.index");
    }


    /**
     * Use to add mosque trasnaction
     *
     * @param MosqueTransactionService $service
     * @param StoreMosqueTransactionRequest $request
     * @param integer $mosqueId
     * @return RedirectResponse
     */
    public function store(MosqueTransactionService $service, StoreMosqueTransactionRequest $request, int $mosqueId): RedirectResponse
    {
        $response = $service->addNewData($request->validated(), $mosqueId);
        if ($this->isError($response)) return $this->getErrorResponse()->withInput();
        return redirect()->back()->with(["success" => "Tambah data transaksi berhasil"]);
    }
}
