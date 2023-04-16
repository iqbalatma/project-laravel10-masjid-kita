<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Services\Masters\DistrictService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistrictController extends Controller
{
    public function index(DistrictService $srevice): Response
    {
        viewShare($srevice->getAllData());
        return response()->view("masters.districts.index");
    }
}
