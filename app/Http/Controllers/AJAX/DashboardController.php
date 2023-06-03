<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\Ajax\AjaxDashboardService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(AjaxDashboardService $service):JsonResponse
    {
        return response()->json($service->getAllData());
    }
}
