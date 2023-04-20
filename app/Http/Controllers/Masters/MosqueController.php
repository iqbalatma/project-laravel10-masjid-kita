<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Services\Masters\MosqueService;
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
}
