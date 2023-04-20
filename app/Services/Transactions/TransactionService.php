<?php

namespace App\Services\Transactions;

use App\Contracts\Interfaces\Transactions\TransactionServiceInterface;
use App\Repositories\TransactionRepository;
use App\Services\BaseService;

class TransactionService extends BaseService implements TransactionServiceInterface
{

    protected $repository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "transaksi" => route('transactions.index'),
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
            "title" => "Transaksi",
            "cardTitle" => "Data Transaksi Masjid",
            "description" => "Data transaksi masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "transactions" => $this->repository->getAllDataPaginated(),
        ];
    }
}
