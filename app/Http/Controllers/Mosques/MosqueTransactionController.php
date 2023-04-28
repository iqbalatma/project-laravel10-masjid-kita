<?php

namespace App\Http\Controllers\Mosques;

use App\Http\Controllers\Controller;
use App\Services\Mosques\MosqueTransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MosqueTransactionController extends Controller
{
    public function index(MosqueTransactionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("mosques.transactions.index");
    }
}
