<?php

namespace App\Services\Mosques;

use App\Contracts\Abstracts\Mosques\BaseMosqueTransactionService;
use App\Contracts\Interfaces\Mosques\MosqueTransactionServiceInterface;
use App\Repositories\TransactionImageRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionTypeRepository;
use App\Services\Transactions\TransactionService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MosqueTransactionService extends BaseMosqueTransactionService implements MosqueTransactionServiceInterface
{
    protected $repository;
    protected $transactionImageRepo;
    private TransactionTypeRepository $transactionTypeRepo;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new TransactionRepository();
        $this->transactionImageRepo = new TransactionImageRepository();
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
        $mosque = $this->mosqueRepo->getDataById($mosqueId);
        Gate::authorize("store", $mosque);
        $this->addBreadCumbs(["transaksi masjid" => route("mosque.transactions.index", ["mosque_id" => request()->route("mosque_id"), "type" => request()->route("type")])]);

        $dataResponse = [
            "transactionTypes" => $this->transactionTypeRepo->getAllData(),
            "breadcumbs" => $this->getBreadcumbs(),
        ];
        if ($type == "all") {
            $dataResponse["title"] = "Semua Data Transaksi Majsid $mosque->name";
            $dataResponse["cardTitle"] = "Transaksi Masjid";
            $dataResponse["description"] = "Semua data transaksi pada masjid";
            $dataResponse["transactions"] = $this->repository->with(["mosque", "transaction_images"])->orderBy(["status_change_at"], "status_change_at", "DESC")->getDataApprovedTransactionPaginated($mosqueId);
        } elseif ($type == "submissions") {
            $dataResponse["title"] = "Pengajuan Transaksi Masjid $mosque->name";
            $dataResponse["cardTitle"] = "Pengajuan Transaksi Masjid";
            $dataResponse["description"] = "Semua data pengajuan transaksi yang belum di approved";
            $dataResponse["transactions"] = $this->repository->with(["mosque", "transaction_images"])->orderBy(["created_at"], "created_at", "DESC")->getDataTransactionSubmissionPaginated($mosqueId);
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
        $mosque = $this->mosqueRepo->getDataById($mosqueId);
        Gate::authorize("store", $mosque);

        try {
            DB::beginTransaction();
            $requestedData["mosque_id"] = $mosqueId;
            $requestedData["code"] = TransactionService::getGeneratedCode();

            $transaction = $this->repository->addNewData($requestedData);

            if (isset($requestedData["transaction_images"])) {
                foreach (request()->file("transaction_images") as $uploadedFile) {
                    $uploaded = Storage::putFile("transactions-images", $uploadedFile);
                    $this->transactionImageRepo->addNewData([
                        "image" => $uploaded,
                        "transaction_id" => $transaction->id
                    ]);
                }
            }


            $response = [
                "success" => true,
            ];

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
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
        $mosque = $this->mosqueRepo->getDataById($mosqueId);
        Gate::authorize("update", $mosque);
        try {
            $this->checkData($id);
            $transaction = $this->getServiceEntity();
            $requestedData["status_change_at"] = Carbon::now();
            $transaction->fill($requestedData);
            $transaction->save();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}
