<?php

namespace App\Services\Mosques;

use App\Contracts\Abstracts\Mosques\BaseMosqueTransactionService;
use App\Contracts\Interfaces\Mosques\MosqueTransactionServiceInterface;
use App\Models\TransactionType;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionTypeRepository;
use Carbon\Carbon;
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
        ];
    }


    /**
     * Use to get all data
     *
     * @param integer $mosqueId
     * @param string $type
     * @return array
     */
    public function getAllData(int $mosqueId, string $type): array
    {
        $this->checkAccess($mosqueId);
        $this->addBreadCumbs(["transaksi masjid" => route("mosque.transactions.index", ["mosque_id" => request()->route("mosque_id"), "type" => request()->route("type")])]);
        $mosque = $this->getMosque();

        $dataResponse = [
            "transactionTypes" => $this->transactionTypeRepo->getAllData(),
            "breadcumbs" => $this->getBreadcumbs(),
        ];
        if ($type == "all") {
            $dataResponse["title"] = "Semua Data Transaksi Majsid $mosque->name";
            $dataResponse["cardTitle"] = "Transaksi Masjid";
            $dataResponse["description"] = "Semua data transaksi pada masjid";
            $dataResponse["transactions"] = $this->repository->with(["mosque"])->orderBy(["status_change_at"], "status_change_at", "DESC")->getDataApprovedTransactionPaginated($mosqueId);
        } elseif ($type == "submissions") {
            $dataResponse["title"] = "Pengajuan Transaksi Masjid $mosque->name";
            $dataResponse["cardTitle"] = "Pengajuan Transaksi Masjid";
            $dataResponse["description"] = "Semua data pengajuan transaksi yang belum di approved";
            $dataResponse["transactions"] =  $this->repository->with(["mosque"])->orderBy(["created_at"], "created_at", "DESC")->getDataTransactionSubmissionPaginated($mosqueId);
        }

        return $dataResponse;
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

    /**
     * Use to change approval
     *
     * @param integer $mosqueId
     * @param integer $id
     * @param array $requestedData
     * @return array
     */
    public function approval(int $mosqueId, int $id, array $requestedData): array
    {
        $this->checkAccess($mosqueId);
        try {
            $this->checkData($id);
            $transaction = $this->getData();
            $requestedData["status_change_at"] = Carbon::now();
            $transaction->fill($requestedData);
            $transaction->save();

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
