<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Services\Masters\SubdistrictService;
use Illuminate\Http\Request;
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
}
