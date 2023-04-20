<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\MosqueServiceInterface;
use App\Repositories\MosqueRepository;
use App\Repositories\VillageRepository;
use App\Services\BaseService;
use Exception;

class MosqueService extends BaseService implements MosqueServiceInterface
{
    protected $repository;
    protected $villageRepo;

    public function __construct()
    {
        $this->repository = new MosqueRepository();
        $this->villageRepo = new VillageRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "masjid" => route("masters.districts.index")
        ];
    }


    /**
     * Use to get data for index
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Masjid",
            "cardTitle" => "Data Msjid",
            "description" => "Data masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "mosques" => $this->repository->getAllDataPaginated(),
            "villages" => $this->villageRepo->getAllData()
        ];
    }


    /**
     * Use to add new data
     *
     * @param array $requestedData
     * @return array
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);
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
     * Use to delete data by id
     *
     * @param integer $id
     * @return array
     */
    public function deleteDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $this->getData()->delete();
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
}
