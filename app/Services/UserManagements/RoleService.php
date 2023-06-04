<?php

namespace App\Services\UserManagements;

use App\Contracts\Interfaces\UserManagements\RoleServiceInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class RoleService extends BaseService implements RoleServiceInterface
{
    protected $repository;
    protected $permissionRepo;
    public function __construct()
    {
        $this->repository = new RoleRepository();
        $this->permissionRepo = new PermissionRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Role",
            "description" => "Role of every user to differentiate their access right",
            "cardTitle"   => "Roles",
            "roles"       => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * Use to give data for create view
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Role",
            "description" => "Role of every user to differentiate their access right",
            "cardTitle"   => "Roles",
            "roles"       => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * Use to show data for edit
     *
     * @param integer $id
     * @return array
     */
    public function getEditData(int $id): array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();
            $permissions = $this->permissionRepo->getAllData();
            $this->setActivePermission($permissions, $role);

            $response = [
                "title" => "Role",
                "success" => true,
                "role" => $role,
                "permissions" => $permissions
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
     * Use to add new data role
     *
     * @param array $requestedData
     * @return array $response
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $response = [
                "success" => true,
                "role" => $this->repository->addNewData($requestedData)
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ? $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }


    /**
     * Use to delete data by id
     *
     * @param integer $id
     * @return array
     */
    public function deleteDataById(int $id): array
    {
        try {
            $this->checkData($id);

            $this->repository->deleteDataById($id);

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
     * Use to update data by id
     *
     * @param integer $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();
            $role->syncPermissions($requestedData);

            $response = [
                "success" => true,
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
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
     * Use to set active permissions on role
     *
     * @param object|null $permissions
     * @param object $role
     * @return void
     */
    private function setActivePermission(object|null &$permissions, object $role): void
    {
        $rolePermission =  array_flip($role->permissions->pluck("name")->toArray());
        $permissions = collect($permissions)->map(function ($item) use ($rolePermission) {
            $item["is_active"] = isset($rolePermission[$item["name"]]);

            return $item;
        });
    }
}
