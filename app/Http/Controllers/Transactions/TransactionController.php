<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\TransactionService;
use Illuminate\Http\Response;

class TransactionController extends Controller
{

    /**
     * Use to show transaction
     *
     * @param TransactionService $service
     * @return Response
     */
    public function index(TransactionService $service, string $type = "all"): Response
    {
        viewShare($service->getAllData($type));
        return response()->view("transactions.index");
    }
}
