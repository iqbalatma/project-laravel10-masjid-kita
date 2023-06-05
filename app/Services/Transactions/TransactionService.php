<?php

namespace App\Services\Transactions;

use App\Contracts\Interfaces\Transactions\TransactionServiceInterface;
use App\Enums\TableEnum;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionTypeRepository;
use App\Services\BaseService;
use Carbon\Carbon;


class TransactionService extends BaseService implements TransactionServiceInterface
{

    protected $repository;
    protected TransactionTypeRepository $transactionTypeRepo;
    public const DEFAULT_CODE_PREFIX = "TRANS";

    private array $filterablelColumnAll;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->transactionTypeRepo = new TransactionTypeRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
        ];

        $this->filterablelColumnAll = [
            "method" => TableEnum::TRANSACTIONS->value.".method",
            "status" => TableEnum::TRANSACTIONS->value.".status",
            "transaction_type_id" => TableEnum::TRANSACTIONS->value.".transaction_type_id",
            "code" => TableEnum::TRANSACTIONS->value.".code",
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
            "transactionTypes" => $this->transactionTypeRepo->getAllData()
        ];
        if ($type == "submissions") {
            $dataReturn["title"] = "Pengajuan Transaksi";
            $dataReturn["cardTitle"] = "Data Pengajuan Transaksi Masjid";
            $dataReturn["description"] = "Data Pengajuan transaksi masjid";
            $dataReturn["transactions"] = $this->repository
                ->orderBy(["created_at"], "created_at", "DESC")
                ->getAllDataPaginated(["status" => "pending"]);
        } else {
            $dataReturn["title"] = "Semua Transaksi";
            $dataReturn["cardTitle"] = "Data Semua Transaksi Masjid";
            $dataReturn["description"] = "Data semua transaksi masjid";
            $dataReturn["transactions"] = $this->repository
                ->orderBy(["created_at"], "status_change_at", "DESC")
                ->filterColumn($this->filterablelColumnAll)
                ->getAllDataPaginated();
        }
        return $dataReturn;
    }


    /**
     * @return string
     */
    public static function getGeneratedCode(): string
    {
        $code = self::DEFAULT_CODE_PREFIX;
        $currentMonth = Carbon::now()->format("Y-m");
        $lastTransaction = (new TransactionRepository())->getLastDataTransaction();
        if ($lastTransaction) {
            if ($lastTransaction->code) {
                $exploded = explode("-", $lastTransaction->code);
                $codeNumber = (int)$exploded[3] + 1;
                $codeNumber = str_pad($codeNumber, 6, "0", STR_PAD_LEFT);
                return "$code-$currentMonth-$codeNumber";
            }
        }
        return "$code-$currentMonth-000001";
    }
}
