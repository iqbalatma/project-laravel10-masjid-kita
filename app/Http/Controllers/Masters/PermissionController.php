<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Services\Masters\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Use to show index view
     *
     * @param PermissionService $service
     * @return Response
     */
    public function __invoke(PermissionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.permissions.index");
    }
}
