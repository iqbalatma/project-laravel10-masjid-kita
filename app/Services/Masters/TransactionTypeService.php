<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\TransactionTypeServiceInterface;
use App\Repositories\TransactionTypeRepository;
use App\Repositories\VillageRepository;
use App\Services\BaseService;
use Exception;

class TransactionTypeService extends BaseService implements TransactionTypeServiceInterface
{
    protected $repository;
    protected $villageRepo;

    public function __construct()
    {
        $this->repository = new TransactionTypeRepository();
        $this->villageRepo = new VillageRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "tipe transaksi" => route("masters.transaction.types.index")
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
            "title" => "Tipe Transaksi",
            "cardTitle" => "Tipe Transaksi",
            "description" => "Data Tipe Transaksi",
            "breadcumbs" => $this->getBreadcumbs(),
            "transactionTypes" => $this->repository->getAllDataPaginated(),
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

            $transactionType = $this->getData();
            $transactionType->fill($requestedData);
            $transactionType->save();

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
