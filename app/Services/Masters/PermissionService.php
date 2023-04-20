<?php

namespace App\Services\Masters;

use App\Repositories\Masters\PermissionRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;


class PermissionService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new PermissionRepository();
    }

    /**
     * Use to get all data for index view
     *
     * @return array
     */
    public function getAllData(): array
    {
        try {
            $response = [
                "title" => "Izin Akses",
                "description" => "Data izin akses",
                "cardTitle" => "Izin Akses",
                "permissions" => $this->repository->getAllDataPaginated(),
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
}
