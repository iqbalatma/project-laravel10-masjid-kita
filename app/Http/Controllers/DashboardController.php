<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * @param DashboardService $service
     * @return Response
     */
    public function __invoke(DashboardService $service):Response
    {
        viewShare($service->getAllData());
        return response()->view("dashboard");
    }
}
