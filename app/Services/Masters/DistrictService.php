<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\DistrictServiceInterface;
use App\Repositories\Masters\DistrictRepository;
use App\Services\BaseService;
use Exception;

class DistrictService extends BaseService implements DistrictServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new DistrictRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "kabupaten" => route("masters.districts.index")
        ];
    }

    /**
     * Use to show all data districts
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Kabupaten",
            "description" => "Data kabupaten",
            "breadcumbs" => $this->getBreadcumbs(),
            "districts" => $this->repository->getAllDataPaginated()
        ];
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

            $district = $this->getData();
            $district->fill($requestedData);
            $district->save();

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
