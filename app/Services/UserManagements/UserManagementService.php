<?php

namespace App\Services\UserManagements;

use App\Contracts\Interfaces\UserManagements\UserManagementServiceInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Iqbalatma\LaravelServiceRepo\BaseService;


class UsermanagementService extends BaseService implements UserManagementServiceInterface
{
    protected $repository;
    private $roleRepo;
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepo = new RoleRepository();
    }

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "User Management",
            "description" => "Data user of this application",
            "cardTitle"   => "User Management",
            "users"       => $this->repository->getAllDataPaginated(),
            "roles" => $this->roleRepo->getAllData()
        ];
    }


    /**
     * Description : use to add new data user
     *
     * @param array $requestedDatata
     * @return array of new eloquent instance
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $user = $this->repository->addNewData($requestedData);
            $user->assignRole($requestedData["roles"]);
            // dispatch(new SendVerificationEmailJob($user));

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }


    /**
     * Description : use to update data user by user id
     *
     * @param int $id of user that want to be updated
     * @param array $requestedData request from client
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $requestedRoles = $requestedData["roles"];
            if (!$requestedData["password"]) {
                unset($requestedData["password"]);
            } else {
                $requestedData["password"] = Hash::make($requestedData["password"]);
            }
            unset($requestedData["roles"]);

            $this->checkData($id);
            $user = $this->repository->updateDataById($id, $requestedData);
            $user->syncRoles($requestedRoles);
            $response =  [
                "success" => true,
                "user" => $user
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }


    /**
     * Delete data user by id
     * @param int $id
     * @return array
     */
    public function changeStatusById(int $id): array
    {
        try {
            $this->checkData($id);
            $user = $this->getServiceEntity();
            $user->status = $user->status == "active" ? "inactive" : "active";
            $user->save();
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }


    /**
     * Use to set status active roles
     *
     * @param object|null $roles
     * @param object|null $userRoles
     * @return void
     */
    private function setActiveRoles(object|null &$roles, object|null $userRoles)
    {
        $userRoles =  array_flip($userRoles->pluck("name")->toArray());

        $roles = collect($roles)->map(function ($item) use ($userRoles) {
            $item["is_active"] = isset($userRoles[$item["name"]]);

            return $item;
        });
    }
}
