<?php

namespace App\Services\Transactions;

use App\Contracts\Interfaces\Transactions\TransactionServiceInterface;
use App\Repositories\TransactionRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;

class TransactionService extends BaseService implements TransactionServiceInterface
{

    protected $repository;
    public const DEFAULT_CODE_PREFIX = "TRANS";

    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
        ];
    }

    /**
     * Use to get data for index
     *
     * @return array
     */
    public function getAllData(string $type): array
    {
        $this->addBreadCumbs(["transaksi" => route('transactions.index', request()->route('type'))]);
        $dataReturn = [
            "breadcumbs" => $this->getBreadcumbs(),
        ];
        if ($type == "submissions") {
            $dataReturn["title"] = "Pengajuan Transaksi";
            $dataReturn["cardTitle"] = "Data Pengajuan Transaksi Masjid";
            $dataReturn["description"] = "Data Pengajuan transaksi masjid";
            $dataReturn["transactions"] = $this->repository->orderBy(["created_at"], "created_at", "DESC")->getAllDataPaginated(["status" => "pending"]);
        } else {
            $dataReturn["title"] = "Semua Transaksi";
            $dataReturn["cardTitle"] = "Data Semua Transaksi Masjid";
            $dataReturn["description"] = "Data semua transaksi masjid";
            $dataReturn["transactions"] = $this->repository->orderBy(["created_at"], "status_change_at", "DESC")->getAllDataPaginated();
        }
        return $dataReturn;
    }

    public static function getGeneratedCode(): string
    {
        $code = self::DEFAULT_CODE_PREFIX;
        $currentMonth = Carbon::now()->format("Y-m");
        $lastTransaction = (new TransactionRepository())->getLastDataTransaction();
        if ($lastTransaction) {
            if ($lastTransaction->code) {
                $exploded = explode("-", $lastTransaction->code);
                $codeNumber = (int) $exploded[3]+1;
                $codeNumber = str_pad($codeNumber,6, "0", STR_PAD_LEFT);
                return "$code-$currentMonth-$codeNumber";
            }
        }
        return "$code-$currentMonth-000001";
    }
}
