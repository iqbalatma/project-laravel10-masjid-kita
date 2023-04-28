<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{

    /**
     * Use to show transaction
     *
     * @param TransactionService $service
     * @return Response
     */
    public function index(TransactionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("transactions.index");
    }
}
