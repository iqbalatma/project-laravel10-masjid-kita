<?php

namespace App\Http\Controllers\Mosques;

use App\Http\Controllers\Controller;
use App\Services\Mosques\MosqueTransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MosqueTransactionController extends Controller
{
    public function index(MosqueTransactionService $service, int $mosqueId): Response
    {
        viewShare($service->getAllData($mosqueId));
        return response()->view("mosques.transactions.index");
    }
}
