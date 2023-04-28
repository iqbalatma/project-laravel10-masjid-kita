<?php

namespace App\Services\Mosques;

use App\Contracts\Interfaces\Mosques\MosqueTransactionServiceInterface;
use App\Repositories\TransactionRepository;
use App\Services\BaseService;

class MosqueTransactionService extends BaseService implements MosqueTransactionServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new TransactionRepository();
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
    public function getAllData(): array
    {
        return [
            "title" => "Transaksi Masjid",
            "cardTitle" => "Transaksi Masjid",
            "description" => "Transaksi Masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "transactions" => $this->repository->getAllDataPaginated(),
        ];
    }
}
