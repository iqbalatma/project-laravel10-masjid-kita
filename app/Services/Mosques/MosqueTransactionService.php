<?php

namespace App\Services\Mosques;

use App\Contracts\Interfaces\Mosques\MosqueTransactionServiceInterface;
use App\Repositories\MosqueRepository;
use App\Repositories\TransactionRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class MosqueTransactionService extends BaseService implements MosqueTransactionServiceInterface
{
    protected $repository;
    private MosqueRepository $mosqueRepo;
    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->mosqueRepo = new MosqueRepository();
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
        $mosque = $this->mosqueRepo->getDataById($mosqueId);
        return [
            "title" => "Transaksi Masjid $mosque->name",
            "cardTitle" => "Transaksi Masjid",
            "description" => "Transaksi Masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "transactions" =>  $this->repository->with(["mosque"])->getDataByWhereClausePaginated(["mosque_id" => $mosqueId]),
        ];
    }
}
