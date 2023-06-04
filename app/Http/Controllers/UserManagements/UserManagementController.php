<?php

namespace App\Http\Controllers\UserManagements;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagements\UserStoreRequest;
use App\Http\Requests\UserManagements\UserUpdateRequest;
use App\Services\UserManagements\UsermanagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserManagementController extends Controller
{
    /**
     * Description : use to show user management index view
     *
     * @param UserManagementService $service dependency injection
     * @return Response
     */
    public function index(UsermanagementService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("user-managements.users.index");
    }


    /**
     * Description : use to add new data user
     *
     * @param UserManagementService $service dependency injection
     * @param UserStoreRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(UserManagementService $service, UserStoreRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("user.managements.users.index")->with("success", "Tambah data user berhasil");
    }


    /**
     * Description : use to update data user by id
     *
     * @param UserManagementService $service dependency injection
     * @param UserUpdateRequest dependency injection
     * @param int $id of user that want to be edited
     * @return RedirectResponse
     */
    public function update(UserManagementService $service, UserUpdateRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("user.managements.users.index")->with("success", "Memperbaharui data user berhasil");
    }

    /**
     * Use to suspend an user
     * @param UserManagementService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function changeStatusActive(UserManagementService $service, int $id): RedirectResponse
    {
        $response = $service->changeStatusById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("user.managements.users.index")->with("success", "Mengubah status aktif user berhasil");
    }
}
