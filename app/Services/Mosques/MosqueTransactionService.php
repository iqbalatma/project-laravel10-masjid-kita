<?php

namespace App\Services\Mosques;

use App\Contracts\Abstracts\Mosques\BaseMosqueTransactionService;
use App\Contracts\Interfaces\Mosques\MosqueTransactionServiceInterface;
use App\Models\TransactionType;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionTypeRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class MosqueTransactionService extends BaseMosqueTransactionService implements MosqueTransactionServiceInterface
{
    protected $repository;
    private TransactionTypeRepository $transactionTypeRepo;
    public function __construct()
    {
        parent::__construct();
        $this->repository = new TransactionRepository();
        $this->transactionTypeRepo = new TransactionTypeRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "transaksi masjid" => route("mosque.transactions.index", ["mosque_id" => request()->route("mosque_id")])
        ];
    }


    /**
     * Use to get data for index
     *
     * @return array
     */
    public function getAllData(int $mosqueId): array
    {
        $this->checkAccess($mosqueId);
        $mosque = $this->getMosque();
        return [
            "title" => "Transaksi Masjid $mosque->name",
            "cardTitle" => "Transaksi Masjid",
            "description" => "Transaksi Masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "transactionTypes" => $this->transactionTypeRepo->getAllData(),
            "transactions" =>  $this->repository->with(["mosque"])->getDataByWhereClausePaginated(["mosque_id" => $mosqueId]),
        ];
    }


    /**
     * Yse to add data transaction
     *
     * @param array $requestedData
     * @param integer $mosqueId
     * @return array
     */
    public function addNewData(array $requestedData, int $mosqueId): array
    {
        $this->checkAccess($mosqueId);
        try {
            $requestedData["mosque_id"] = $mosqueId;
            $requestedData["user_id"] = Auth::id();
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
}
