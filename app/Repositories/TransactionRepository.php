<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseRepository;


class TransactionRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }

    public function getLastDataTransaction(): ?Transaction
    {
        return $this->model->whereMonth("created_at", Carbon::now()->format("m"))
            ->whereYear("created_at", Carbon::now()->format("Y"))
            ->latest()
            ->first();
    }

    public function getDataApprovedTransactionPaginated(string $mosqueId, array $columns = ["*"])
    {
        return $this->model
            ->select($columns)
            ->where([
                "mosque_id" => $mosqueId,
            ])
            ->whereNot("status", "pending")
            ->paginate(request()->query("perpage", config("servicerepo.perpage")));
    }

    public function getDataTransactionSubmissionPaginated(string $mosqueId, array $columns = ["*"])
    {
        return $this->model
            ->select($columns)
            ->where([
                "mosque_id" => $mosqueId,
                "status" => "pending"
            ])
            ->paginate(request()->query("perpage", config("servicerepo.perpage")));
    }

    public function getDataTransactionDailyInAMonth()
    {
        return $this->model
            ->approved()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw("sum(amount) as amount"), "method")
            ->groupBy("date")
            ->groupBy("method")
//            ->whereBetween('created_at', [
//                Carbon::now()->startOfMonth(),
//                Carbon::now()->endOfMonth()
//            ])
            ->get();
    }
}
