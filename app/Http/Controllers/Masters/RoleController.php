<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\Roles\StoreRoleRequest;
use App\Http\Requests\Masters\Roles\UpdateRoleRequest;
use App\Services\Masters\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Description : use to show all data roles
     *
     * @param RoleService $service dependency injection
     */
    public function index(RoleService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("masters.roles.index");
    }

    /**
     * Use to show create form
     *
     * @param RoleService $service
     * @return Response
     */
    public function create(RoleService $service): Response
    {
        viewShare($service->getCreateData());
        return response()->view("masters.roles.create");
    }

    /**
     * Use to add new data role
     *
     * @param RoleService $service
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleService $service, StoreRoleRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response, "masters.roles.create")) return $this->getErrorResponse();

        return redirect()->route("masters.roles.index")->with("success", "Add new role successfully");
    }

    /**
     * Use to delete role
     *
     * @param RoleService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(RoleService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("masters.roles.index")->with("success", "Delete role successfully");
    }

    /**
     * Use to show form edit for role
     *
     * @param RoleService $service
     * @param integer $id
     * @return Response|RedirectResponse
     */
    public function edit(RoleService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("masters.roles.edit");
    }


    /**
     * use to update data role by id
     *
     * @param RoleService $service
     * @param UpdateRoleRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(RoleService $service, UpdateRoleRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("masters.roles.index")->with("success", "Update data role successfully");
    }
}
