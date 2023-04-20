<?php

namespace App\Http\Controllers\UserManagements;

use App\Http\Controllers\Controller;
use App\Services\UserManagements\PermissionService;
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
        return response()->view("user-managements.permissions.index");
    }
}
