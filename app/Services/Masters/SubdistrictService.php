<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\SubdistrictServiceInterface;
use App\Repositories\Masters\SubdistrictRepository;
use App\Services\BaseService;
use Exception;

class SubdistrictService extends BaseService implements SubdistrictServiceInterface
{
    protected $repository;
    protected array $breadcumbs;
    public function __construct()
    {
        $this->repository = new SubdistrictRepository();

        //FIXME - this is default, data, need to wait for link
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "Master",
            "subdistricts" => route("masters.subdistricts.index")
        ];
    }


    /**
     * use to get all data subdsitrict
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Subdstricts",
            "description" => "Data of subdistrict",
            "breadcumbs" => $this->getBreadcumbs(),
            "subdistricts" => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * use add new data
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
                "message" => config('app.env') != 'production' ? 'Something went wrong' : $e->getMessage()
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

            $subdistrict = $this->getData();
            $subdistrict->fill($requestedData);
            $subdistrict->save();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ? 'Something went wrong' : $e->getMessage()
            ];
        }
        return $response;
    }
}